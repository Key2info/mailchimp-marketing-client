<?php

namespace ADB\MailchimpMarketingClient\Api;

use ADB\MailchimpMarketingClient\Configuration;
use Generator;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Log\LoggerAwareInterface;

abstract class MailchimpApi implements LoggerAwareInterface
{
    protected const ACCOUNT_PREFIX = '/accounts/%d';
    protected const VERSION_PREFIX = '/%s';
    protected $perPage = 500;
    /**
     * @var ClientInterface|null
     */
    protected $client;
    /**
     * @var Configuration|null
     */
    protected $configuration;
    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * MailchimpApi constructor.
     * @param ClientInterface|null $client
     * @param Configuration|null $configuration
     */
    public function __construct(ClientInterface $client = null, Configuration $configuration = null)
    {
        $this->client = $client ?: new Client();
        $this->configuration = $configuration ?: Configuration::getDefaultConfiguration();
    }

    /**
     * @return Configuration
     */
    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    /**
     * @param Configuration $configuration
     * @return self
     */
    public function setConfiguration(Configuration $configuration): self
    {
        $this->configuration = $configuration;
        return $this;
    }

    /**
     * @param string $relativePath
     * @param CollectionRequest $request
     * @param int|null $start
     * @param bool $paginate
     * @return Generator
     */
    public function getCollection(string $relativePath, CollectionRequest $request, ?int $start = null, bool $paginate = true): Generator
    {
        $request = clone $request;
        $request->setResultsLimit($this->getPerPage(), $start ?? 0);
        $returnType = $request::getReturnType();

        if (false === $paginate) {
            $request->setResultsLimit(400, 0);
        }

        $this->log('Fetching a collection of type {returnType}.', ['returnType' => $returnType], 'debug');

        try {
            foreach ($this->getPaginatedRequest($relativePath, $request) as $responseBody) {
                try {
                    yield $this->configuration->getSerializer()->deserialize(
                        $responseBody,
                        "{$request->getReturnType()}[]",
                        'json'
                    );
                } catch (ExceptionInterface $e) {
                    $this->log(
                        'Got an exception while trying to deserialize an array of {returnType} objects.',
                        ['returnType' => $returnType, 'request' => $request],
                        'warning'
                    );

                    $this->log(
                        'Failed to deserialize API response.',
                        ['exception' => $e, 'response' => $responseBody],
                        'debug'
                    );
                }

                if (false === $paginate) {
                    break;
                }
            }
        } catch (ApiException $e) {
            // Something went wrong with the API call
            throw $e;
        }
    }

    /**
     * @param string $relativePath
     * @param ItemRequest $request
     * @param string $returnType
     * @return object
     * @throws ExceptionInterface
     */
    public function getItem(string $relativePath, ItemRequest $request, string $returnType)
    {
        try {
            $httpRequest = $this->getHttpRequest($request, "{$relativePath}/{$request->getModelId()}");

            [
                $responseBody,
                $statusCode,
                $responseHeaders,
            ] = $this->sendRequest($httpRequest);

            try {
                return $this->configuration->getSerializer()->deserialize(
                    $responseBody,
                    $returnType,
                    'json'
                );
            } catch (ExceptionInterface $e) {
                $this->log(
                    'Got an exception while trying to deserialize an array of {returnType} objects.',
                    ['returnType' => $returnType, 'request' => $request],
                    'warning'
                );

                $this->log(
                    'Failed to deserialize API response.',
                    ['exception' => $e, 'response' => $responseBody],
                    'debug'
                );

                return null;
            }
        } catch (ApiException $e) {
            // Something went wrong with the API call
            throw $e;
        }
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return self
     */
    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * Logs messages if a logger was passed.
     *
     * @param $msg
     * @param array $context
     * @param string $level One of [debug, info, notice, warning, error, critical, alert, emergency]
     */
    protected function log($msg, array $context = [], $level = 'info'): void
    {
        if (null === $this->logger) {
            return;
        }

        $msg = "[SofTouch API] " . $msg;

        if (method_exists($this->logger, $level)) {
            $this->logger->$level($msg, $context);
        } else {
            $this->log('Wrong log level "{loglevel}" used.', ['loglevel' => $level], 'notice');
            $this->logger->info($msg, $context);
        }
    }

    /**
     * Gets a collection request, page by page.
     *
     * @param string $relativePath
     * @param CollectionRequest $request
     * @return Generator
     */
    public function getPaginatedRequest(string $relativePath, CollectionRequest $request)
    {
        do {
            try {
                // Create Request
                $httpRequest = $this->getHttpRequest($request, $relativePath);

                [
                    $responseBody,
                    $statusCode,
                    $responseHeaders,
                ] = $this->sendRequest($httpRequest);

                yield $responseBody;

                // Update collection pagination.
                $request->setSkip($request->getSkip() + $request->getTake());
            } catch (ExceptionInterface $e) {
                // Serialization exception occurred.
                $this->log('Serialization exception occurred.', ['exception' => $e], 'warning');
                throw new ApiException(null, null, $e);
            }
        } while ($responseBody !== '[]');
    }

    /**
     * Get the HTTP Request.
     *
     * @param ApiRequest $apiRequest
     *
     * @param string $relativePath
     * @return Request
     * @throws ExceptionInterface
     */
    public function getHttpRequest(ApiRequest $apiRequest, string $relativePath)
    {
        $method = 'GET';
        $resourcePath = $this->getResourcePath($relativePath);
        $fullPath = $this->getFullPath($resourcePath);
        $headers = $this->getDefaultHeaders();

        $requestParameters = $this->configuration->getNormalizer()->normalize($apiRequest, null, ['skip_null_values' => true, DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s']);
        $query = build_query($requestParameters);
        $uri = "{$fullPath}?{$query}";

        $this->log('Sending get request to {uri}.', ['uri' => $uri], 'debug');

        return new Request(
            $method,
            $uri,
            $headers
        );
    }

    public function createResource(string $relativePath, CreateRequest $request): object
    {
        $request = clone $request;
        $returnType = $request::getReturnType();

        $this->log('Creating an object of type {returnType}.', ['returnType' => $returnType], 'debug');

        try {
            $responseBody = $this->getCreateRequest($relativePath, $request);
            return $this->configuration->getSerializer()->deserialize(
                $responseBody,
                $request->getReturnType(),
                'json'/*,
                [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s']*/
            );
        } catch (ExceptionInterface $e) {
            $this->log(
                'Got an exception while trying to deserialize an array of {returnType} objects.',
                ['returnType' => $returnType, 'request' => $request],
                'warning'
            );

            $this->log(
                'Failed to deserialize API response.',
                ['exception' => $e, 'response' => $responseBody],
                'debug'
            );
        } catch (ApiException $e) {
            // Something went wrong with the API call
            throw $e;
        }
    }

    public function getCreateRequest(string $relativePath, CreateRequest $request)
    {
        try {
            // Create Request
            $httpRequest = $this->getHttpPostRequest($request, $relativePath);

            [
                $responseBody,
                $statusCode,
                $responseHeaders,
            ] = $this->sendRequest($httpRequest);

            return $responseBody;
        } catch (ExceptionInterface $e) {
            // Serialization exception occurred.
            $this->log('Serialization exception occurred.', ['exception' => $e], 'warning');
            throw new ApiException(null, null, $e);
        }
    }

    /**
     * Get the HTTP POST Request.
     *
     * @param CreateRequest $apiRequest
     *
     * @param string $relativePath
     * @return Request
     * @throws ExceptionInterface
     */
    public function getHttpPostRequest(CreateRequest $apiRequest, string $relativePath)
    {
        $method = 'POST';
        $resourcePath = $this->getResourcePath($relativePath);
        $fullPath = $this->getFullPath($resourcePath);
        $headers = $this->getDefaultHeaders();
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        $requestParameters = $this->configuration->getNormalizer()->normalize($apiRequest, null, ['skip_null_values' => true]);

        return new Request(
            $method,
            $fullPath,
            $headers,
            http_build_query($requestParameters, null, '&')
        );
    }

    /**
     * @param string $relativePath
     * @return string
     */
    protected function getResourcePath(string $relativePath): string
    {
        return $this->getVersionPrefix() . $this->getAccountPrefix() . $relativePath;
    }

    /**
     * @return string
     */
    protected function getVersionPrefix(): string
    {
        return sprintf(
            static::VERSION_PREFIX,
            $this->configuration->getApiVersion()
        );
    }

    /**
     * @return string
     */
    protected function getAccountPrefix(): string
    {
        return sprintf(
            static::ACCOUNT_PREFIX,
            $this->configuration->getAccountId()
        );
    }

    /**
     * @param string $resourcePath
     * @return string
     */
    protected function getFullPath(string $resourcePath): string
    {
        return $this->configuration->getApiUrl() . $resourcePath;
    }

    /**
     * @return array
     */
    protected function getDefaultHeaders(): array
    {
        return [
            'User-Agent' => $this->configuration->getUserAgent(),
        ];
    }

    /**
     * @param Request $httpRequest
     * @param array $options
     * @return array
     * @throws ApiResponseException
     * @throws ApiException
     */
    protected function sendRequest(Request $httpRequest, array $options = []): array
    {
        $this->log(
            '[{requestType}] {requestUrl}',
            [
                'requestType' => $httpRequest->getMethod(),
                'requestUrl' => $httpRequest->getUri()->__toString(),
            ],
            'debug'
        );

        try {
            $httpRequest = $this->authenticateHttpRequest($httpRequest);
            $options = $this->getHttpRequestOptions($options);

            try {
                $response = $this->getClient()->send($httpRequest, $options);
            } catch (RequestException $e) {
                throw new ApiResponseException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            } catch (GuzzleException $e) {
                throw new ApiException(
                    "Unknown HTTP client exception",
                    null,
                    $e
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiResponseException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $httpRequest->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            return [$response->getBody()->getContents(), $statusCode, $response->getHeaders()];
        } catch (ApiResponseException $e) {
            /*
             * Optionally handle response exceptions.
             *
             * switch ($e->getCode()) {
             * }
             */
            throw $e;
        } catch (ApiException $e) {
            throw $e;
        }
    }

    /**
     * @param Request $httpRequest
     * @return Request
     */
    protected function authenticateHttpRequest(Request $httpRequest)
    {
        /** @var Request $withHeader */
        $withHeader = $httpRequest->withAddedHeader(
            'Authorization',
            $this->configuration->getAuthorization()
        );

        return $withHeader;
    }

    /**
     * @param array $options
     * @return array
     */
    protected function getHttpRequestOptions(array $options = []): array
    {
        // If debug is enabled, set debug option.
        if ($this->configuration->isDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->configuration->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new ApiException('Could not open debug file: ' . $this->configuration->getDebugFile());
            }
        }

        return $options;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     * @return self
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param LoggerInterface|null $logger
     * @return self
     */
    public function setLogger(?LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param ApiRequest $apiRequest
     * @return string
     */
    protected function serializeRequest(ApiRequest $apiRequest): string
    {
        $serializer = $this->configuration->getSerializer();
        return $serializer->serialize($apiRequest, 'json');
    }
}

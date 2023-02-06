<?php

namespace ADB\MailchimpMarketingClient;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class Configuration
{
    /** @var Configuration */
    private static $defaultConfiguration;
    protected $apiUrl = 'https://<dc>.api.mailchimp.com/3.0';
    protected $apiVersion = '1';
    protected $apiToken;
    protected $accountId;
    protected $tokenPrefix = 'apikey';
    protected $debug = false;
    protected $debugFile = 'php://output';
    protected $userAgent = 'mailchimp-marketing-client-php/0.1';

    /** @var SerializerInterface */
    protected $serializer;
    /** @var NormalizerInterface */
    protected $normalizer;

    /**
     * Configuration constructor.
     */
    public function __construct()
    {
        AnnotationRegistry::registerLoader('class_exists');
        $annotationReader = new AnnotationReader();

        $classMetadataFactory = new ClassMetadataFactory(
            new AnnotationLoader(
                $annotationReader
            )
        );
        $metadataAwareNameConverter = new MetadataAwareNameConverter(
            $classMetadataFactory,
            new CamelCaseToSnakeCaseNameConverter()
        );


        $this->normalizer = new ObjectNormalizer(
            $classMetadataFactory,
            $metadataAwareNameConverter,
            new PropertyAccessor(),
            new ReflectionExtractor()
        );

        $this->serializer = new Serializer(
            [
                new DateTimeNormalizer([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d']),
                $this->normalizer,
                new ArrayDenormalizer(),
            ],
            [
                'json' => new JsonEncoder(),
                'csv' => new CsvEncoder(),
            ]
        );
    }

    /**
     * @return Configuration
     */
    public static function getDefaultConfiguration(): Configuration
    {
        if (!isset(static::$defaultConfiguration)) {
            static::$defaultConfiguration = new self();
        }

        return static::$defaultConfiguration;
    }

    /**
     * @param Configuration $configuration
     */
    public static function setDefaultConfiguration(Configuration $configuration)
    {
        static::$defaultConfiguration = $configuration;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return Configuration
     */
    public function setApiUrl(string $apiUrl): Configuration
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     * @return Configuration
     */
    public function setApiVersion(string $apiVersion): Configuration
    {
        $this->apiVersion = $apiVersion;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     * @return Configuration
     */
    public function setDebug($debug): Configuration
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     * @return Configuration
     */
    public function setUserAgent(string $userAgent): Configuration
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    /**
     * @param int|null $accountId
     * @return Configuration
     */
    public function setAccountId(?int $accountId): Configuration
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * @return SerializerInterface|null
     */
    public function getSerializer(): ?SerializerInterface
    {
        return $this->serializer;
    }

    /**
     * @param SerializerInterface|null $serializer
     * @return Configuration
     */
    public function setSerializer(?SerializerInterface $serializer): Configuration
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorization(): string
    {
        return sprintf(
            '%s %s',
            $this->getTokenPrefix(),
            $this->getApiToken()
        );
    }

    /**
     * @return string
     */
    public function getTokenPrefix(): string
    {
        return $this->tokenPrefix;
    }

    /**
     * @param string $tokenPrefix
     * @return Configuration
     */
    public function setTokenPrefix(string $tokenPrefix): Configuration
    {
        $this->tokenPrefix = $tokenPrefix;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    /**
     * @param string|null $apiToken
     * @return Configuration
     */
    public function setApiToken($apiToken): Configuration
    {
        $this->apiToken = $apiToken;

        if (strpos($this->apiToken, '-') === false) {
            throw new \Exception("Invalid MailChimp API key `{$apiToken}` supplied.");
        }

        list(, $data_center) = explode('-', $this->apiToken);
        $this->apiUrl  = str_replace('<dc>', $data_center, $this->apiUrl);

        return $this;
    }

    /**
     * @return string
     */
    public function getDebugFile(): string
    {
        return $this->debugFile;
    }

    /**
     * @param string $debugFile
     * @return Configuration
     */
    public function setDebugFile(string $debugFile): Configuration
    {
        $this->debugFile = $debugFile;
        return $this;
    }

    /**
     * @return NormalizerInterface|ObjectNormalizer|null
     */
    public function getNormalizer()
    {
        return $this->normalizer;
    }

    /**
     * @param NormalizerInterface|ObjectNormalizer|null $normalizer
     * @return Configuration
     */
    public function setNormalizer($normalizer)
    {
        $this->normalizer = $normalizer;
        return $this;
    }
}

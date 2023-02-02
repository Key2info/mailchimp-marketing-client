<?php

namespace ADB\MailchimpMarketingClient;

use ADB\MailchimpMarketingClient\ApiException;
use Throwable;

class ApiResponseException extends ApiException
{
    /**
     * The HTTP body of the server response either as Json or string.
     *
     * @var mixed
     */
    protected $responseBody;

    /**
     * The HTTP header of the server response.
     *
     * @var string[]
     */
    protected $responseHeaders;

    public function __construct($message = '', $code = 0, $responseHeaders = [], $responseBody = null, Throwable $previous = null)
    {
        $message = $message ?: 'Got an exception while talking to the Mailchimp API';

        parent::__construct($message, $code, $previous);
        $this->responseHeaders = $responseHeaders;
        $this->responseBody = $responseBody;
    }
}

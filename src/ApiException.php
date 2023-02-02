<?php


namespace ADB\MailchimpMarketingClient;

use RuntimeException;
use Throwable;

class ApiException extends RuntimeException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        $message = $message ?: 'Something went wrong with the Mailchimp API Client.';

        parent::__construct($message, $code, $previous);
    }
}

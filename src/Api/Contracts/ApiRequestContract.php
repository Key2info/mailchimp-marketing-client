<?php

namespace ADB\MailchimpMarketingClient\Api\Contracts;

interface ApiRequestContract
{
    /**
     * Get this request's return type.
     *
     * @return string
     */
    public static function getReturnType(): string;
}

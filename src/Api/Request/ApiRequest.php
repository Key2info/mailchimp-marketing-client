<?php

namespace ADB\MailchimpMarketingClient\Api\Request;

interface ApiRequest
{
    /**
     * Get this request's return type.
     *
     * @return string
     */
    public static function getReturnType(): string;
}

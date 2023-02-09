<?php

namespace ADB\MailchimpMarketingClient\Api\Request;

use ADB\MailchimpMarketingClient\Api\Contracts\ApiRequestContract;
use ADB\MailchimpMarketingClient\Api\Request\CollectionRequest;
use ADB\MailchimpMarketingClient\Api\Traits\CollectionTrait;
use ADB\MailchimpMarketingClient\Model\Member;

class MemberCollectionRequest implements ApiRequestContract, CollectionRequest
{
    use CollectionTrait;

    protected $display = 'full';

    /**
     * @inheritDoc
     */
    public static function getReturnType(): string
    {
        return Member::class;
    }

    /**
     * @return string
     */
    public function getDisplay(): string
    {
        return $this->display;
    }

    /**
     * @param string $display
     * @return MemberCollectionRequest
     */
    public function setDisplay(string $display): MemberCollectionRequest
    {
        $this->display = $display;
        return $this;
    }
}

<?php

namespace ADB\MailchimpMarketingClient\Api\Request;

use ADB\MailchimpMarketingClient\Api\Contracts\ApiRequestContract;
use ADB\MailchimpMarketingClient\Api\Request\CollectionRequestContract;
use ADB\MailchimpMarketingClient\Api\Traits\CollectionTrait;
use ADB\MailchimpMarketingClient\Model\Campaign;

class CampaignCollectionRequest implements ApiRequestContract, CollectionRequestContract
{
    use CollectionTrait;

    protected $display = 'full';

    /**
     * @inheritDoc
     */
    public static function getReturnType(): string
    {
        return Campaign::class;
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
     * @return CampaignCollectionRequest
     */
    public function setDisplay(string $display): CampaignCollectionRequest
    {
        $this->display = $display;
        return $this;
    }
}

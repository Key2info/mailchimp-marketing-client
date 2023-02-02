<?php

namespace ADB\MailchimpMarketing\Api;

use ADB\MailchimpMarketingClient\Api\MailchimpApi;
use ADB\MailchimpMarketingClient\Api\Request\CampaignCollectionRequest;
use ADB\MailchimpMarketingClient\Model\Campaign;

class CampaginApi extends MailchimpApi
{
    /**
     * Get a collection of items.
     *
     * @param int|null $start
     * @return Campaign[]
     */
    public function get(?int $start = null): iterable
    {
        $request = (new CampaignCollectionRequest())
            ->setAccountId($this->configuration->getAccountId());

        foreach ($this->getCollection('/campaigns', $request) as $campaigns) {
            yield from $campaigns;
        }
    }
}

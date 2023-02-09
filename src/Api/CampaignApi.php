<?php

namespace ADB\MailchimpMarketingClient\Api;

use ADB\MailchimpMarketingClient\Api\MailchimpApi;
use ADB\MailchimpMarketingClient\Api\Request\CampaignCollectionRequest;
use ADB\MailchimpMarketingClient\Api\Request\ItemRequest;
use ADB\MailchimpMarketingClient\Model\Campaign;

class CampaignApi extends MailchimpApi
{
    /**
     * Get a collection of items.
     *
     * @param int|null $start
     * @return Campaign[]
     */
    public function get(?int $start = null)
    {
        $request = new CampaignCollectionRequest();

        foreach ($this->getCollection('/campaigns', $request) as $campaigns) {
            yield from $campaigns;
        }
    }

    /**
     * Get a single item.
     *
     * @param string $modelId
     * @return ?Season
     */
    public function getSingle(string $modelId)
    {
        $request = new ItemRequest();
        $request->setModelId($modelId);

        try {
            $campaign = $this->getItem('/campaigns', $request, Campaign::class);
            return $campaign instanceof Campaign ? $campaign : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}

<?php

namespace ADB\MailchimpMarketingClient\Api;

use ADB\MailchimpMarketingClient\Api\MailchimpApi;
use ADB\MailchimpMarketingClient\Api\Request\ItemRequest;
use ADB\MailchimpMarketingClient\Api\Request\MemberCollectionRequest;
use ADB\MailchimpMarketingClient\Model\Member;

class MemberAPi extends MailchimpApi
{
    /**
     * Get a collection of items.
     *
     * @param int $start
     * @param int|null $start
     * @return Member[]
     */
    public function get($list_id, ?int $start = null)
    {
        $request = new MemberCollectionRequest();

        foreach ($this->getCollection("/lists/{$list_id}/members", $request) as $members) {
            yield from $members;
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
            $member = $this->getItem("/lists/{$list_id}/members/{$subscriber_hash}", $request, Member::class);
            return $member instanceof Member ? $member : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}

<?php

namespace ADB\MailchimpMarketingClient\Api\Contracts;

use ADB\MailchimpMarketingClient\Api\Contracts\ApiRequestContract;

interface CollectionRequestContract extends ApiRequestContract
{
    /**
     * @param int $take Number of items to take.
     * @param int|null $skip Item offset.
     * @return $this
     */
    public function setResultsLimit(int $take, ?int $skip = null);

    /**
     * @return int
     */
    public function getTake(): int;

    /**
     * @param int $take
     * @return self
     */
    public function setTake(int $take);

    /**
     * @return int|null
     */
    public function getSkip(): ?int;

    /**
     * @param int|null $skip
     * @return self
     */
    public function setSkip(?int $skip);
}

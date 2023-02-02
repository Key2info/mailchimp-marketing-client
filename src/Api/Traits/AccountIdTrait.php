<?php

namespace ADB\MailchimpMarketingClient\Api\Traits;

trait AccountIdTrait
{
    protected $accountId;

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     * @return self
     */
    public function setAccountId(int $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }
}

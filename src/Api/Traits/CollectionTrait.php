<?php

namespace ADB\MailchimpMarketingClient\Api\Traits;

trait CollectionTrait
{
    protected $take;
    protected $skip;

    /**
     * @inheritDoc
     */
    public function setResultsLimit(int $take, ?int $skip = null)
    {
        $this->take = $take;
        $this->skip = $skip;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTake(): int
    {
        return $this->take;
    }

    /**
     * @inheritDoc
     */
    public function setTake(int $take)
    {
        $this->take = $take;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSkip(): ?int
    {
        return $this->skip;
    }

    /**
     * @inheritDoc
     */
    public function setSkip(?int $skip)
    {
        $this->skip = $skip;
        return $this;
    }
}

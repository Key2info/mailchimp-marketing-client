<?php

namespace ADB\MailchimpMarketingClient\Model;

class Campaign
{
    /**
     *A brands unique key.
     * @var string
     */
    protected $key;

    /**
     * The brand name.
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Campaign
     */
    public function setKey(string $key): Campaign
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Campaign
     */
    public function setName(string $name): Campaign
    {
        $this->name = $name;
        return $this;
    }
}

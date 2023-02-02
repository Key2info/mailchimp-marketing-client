<?php

namespace ADB\MailchimpMarketingClient\Model;

class CustomerJourneys
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
     * @return CustomerJourneys
     */
    public function setKey(string $key): CustomerJourneys
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
     * @return CustomerJourneys
     */
    public function setName(string $name): CustomerJourneys
    {
        $this->name = $name;
        return $this;
    }
}

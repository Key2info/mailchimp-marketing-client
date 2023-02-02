<?php

namespace ADB\MailchimpMarketingClient\Model;

class ListsAudiences
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
     * @return ListsAudiences
     */
    public function setKey(string $key): ListsAudiences
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
     * @return ListsAudiences
     */
    public function setName(string $name): ListsAudiences
    {
        $this->name = $name;
        return $this;
    }
}

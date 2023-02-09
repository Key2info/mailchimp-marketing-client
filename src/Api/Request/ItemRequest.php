<?php

namespace ADB\MailchimpMarketingClient\Api\Request;

use Symfony\Component\Serializer\Annotation\SerializedName;

class ItemRequest implements ApiRequest
{
    /**
     * id: an integer value representing the id of an article.
     * @var int|null
     * @SerializedName("modelId")
     */
    protected $modelId;

    /**
     * @return string|null
     */
    public function getModelId(): ?string
    {
        return $this->modelId;
    }

    /**
     * @param string|null $modelId
     * @return ItemRequest
     */
    public function setModelId(?string $modelId): ItemRequest
    {
        $this->modelId = $modelId;
        return $this;
    }

    public static function getReturnType(): string
    {
        throw new \Exception("Item request has no single return type!");
    }
}

<?php

namespace ADB\MailchimpMarketingClient\Model;

class Campaign
{
    protected $id;

    protected $webId;

    protected $parentCampaignId;

    protected $type;

    protected $createTime;

    protected $archiveUrl;

    protected $longArchiveUrl;

    protected $status;

    protected $emailsSent;

    protected $sendTime;

    protected $contentType;

    protected $needsBlockRefresh;

    protected $resenable;

    protected $recipients = [];

    protected $settings = [];

    protected $variantSettings = [];

    protected $tracking = [];

    protected $rssOpts = [];

    protected $abSplitOpts = [];

    protected $socialCard = [];

    protected $reportSummary = [];

    protected $deliveryStatus = [];

    protected $links = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Campaign
     */
    public function setId(string $id): Campaign
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLongArchiveUrl(): string
    {
        return $this->longArchiveUrl;
    }

    /**
     * @param string $longArchiveUrl
     * @return Campaign
     */
    public function setLongArchiveUrl(string $longArchiveUrl): Campaign
    {
        $this->longArchiveUrl = $longArchiveUrl;

        return $this;
    }

    /**
     * Get the value of webId
     */
    public function getWebId()
    {
        return $this->webId;
    }

    /**
     * Set the value of webId
     *
     * @return  self
     */
    public function setWebId($webId)
    {
        $this->webId = $webId;

        return $this;
    }

    /**
     * Get the value of resenable
     */
    public function getResenable()
    {
        return $this->resenable;
    }

    /**
     * Set the value of resenable
     *
     * @return  self
     */
    public function setResenable($resenable)
    {
        $this->resenable = $resenable;

        return $this;
    }

    /**
     * Get the value of needsBlockRefresh
     */
    public function getNeedsBlockRefresh()
    {
        return $this->needsBlockRefresh;
    }

    /**
     * Set the value of needsBlockRefresh
     *
     * @return  self
     */
    public function setNeedsBlockRefresh($needsBlockRefresh)
    {
        $this->needsBlockRefresh = $needsBlockRefresh;

        return $this;
    }

    /**
     * Get the value of contentType
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set the value of contentType
     *
     * @return  self
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get the value of sendTime
     */
    public function getSendTime()
    {
        return $this->sendTime;
    }

    /**
     * Set the value of sendTime
     *
     * @return  self
     */
    public function setSendTime($sendTime)
    {
        $this->sendTime = $sendTime;

        return $this;
    }

    /**
     * Get the value of emailsSent
     */
    public function getEmailsSent()
    {
        return $this->emailsSent;
    }

    /**
     * Set the value of emailsSent
     *
     * @return  self
     */
    public function setEmailsSent($emailsSent)
    {
        $this->emailsSent = $emailsSent;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of archiveUrl
     */
    public function getArchiveUrl()
    {
        return $this->archiveUrl;
    }

    /**
     * Set the value of archiveUrl
     *
     * @return  self
     */
    public function setArchiveUrl($archiveUrl)
    {
        $this->archiveUrl = $archiveUrl;

        return $this;
    }

    /**
     * Get the value of createTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set the value of createTime
     *
     * @return  self
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of parentCampaignId
     */
    public function getParentCampaignId()
    {
        return $this->parentCampaignId;
    }

    /**
     * Set the value of parentCampaignId
     *
     * @return  self
     */
    public function setParentCampaignId($parentCampaignId)
    {
        $this->parentCampaignId = $parentCampaignId;

        return $this;
    }

    /**
     * Get the value of recipients
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Set the value of recipients
     *
     * @return  self
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;

        return $this;
    }

    /**
     * Get the value of settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set the value of settings
     *
     * @return  self
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get the value of variantSettings
     */
    public function getVariantSettings()
    {
        return $this->variantSettings;
    }

    /**
     * Set the value of variantSettings
     *
     * @return  self
     */
    public function setVariantSettings($variantSettings)
    {
        $this->variantSettings = $variantSettings;

        return $this;
    }

    /**
     * Get the value of tracking
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * Set the value of tracking
     *
     * @return  self
     */
    public function setTracking($tracking)
    {
        $this->tracking = $tracking;

        return $this;
    }

    /**
     * Get the value of abSplitOpts
     */
    public function getAbSplitOpts()
    {
        return $this->abSplitOpts;
    }

    /**
     * Set the value of abSplitOpts
     *
     * @return  self
     */
    public function setAbSplitOpts($abSplitOpts)
    {
        $this->abSplitOpts = $abSplitOpts;

        return $this;
    }

    /**
     * Get the value of socialCard
     */
    public function getSocialCard()
    {
        return $this->socialCard;
    }

    /**
     * Set the value of socialCard
     *
     * @return  self
     */
    public function setSocialCard($socialCard)
    {
        $this->socialCard = $socialCard;

        return $this;
    }

    /**
     * Get the value of reportSummary
     */
    public function getReportSummary()
    {
        return $this->reportSummary;
    }

    /**
     * Set the value of reportSummary
     *
     * @return  self
     */
    public function setReportSummary($reportSummary)
    {
        $this->reportSummary = $reportSummary;

        return $this;
    }

    /**
     * Get the value of deliveryStatus
     */
    public function getDeliveryStatus()
    {
        return $this->deliveryStatus;
    }

    /**
     * Set the value of deliveryStatus
     *
     * @return  self
     */
    public function setDeliveryStatus($deliveryStatus)
    {
        $this->deliveryStatus = $deliveryStatus;

        return $this;
    }

    /**
     * Get the value of links
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the value of links
     *
     * @return  self
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }
}

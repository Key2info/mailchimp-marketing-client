<?php

namespace ADB\MailchimpMarketingClient\Model;

class Member
{
    public $id;

    public $emailAdress;

    public $uniqueEmailId;

    public $contactId;

    public $fullName;

    public $webId;

    public $emailType;

    public $status;

    public $unsubscribeReason;

    public $consentToOneToOneMessaging;

    public $mergeFields = [];

    public $interests = [];

    public $stats = [];

    public $ipSignup;

    public $timestampSignup;

    public $ipOpt;

    public $timestampOpt;

    public $memberRating;

    public $lastChanged;

    public $language;

    public $vip;

    public $emailClient;

    public $location = [];

    public $marketingPermissions = [];

    public $lastNote = [];

    public $source;

    public $tagsCount;

    public $tags = [];

    public $listId;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of emailAdress
     */
    public function getEmailAdress()
    {
        return $this->emailAdress;
    }

    /**
     * Set the value of emailAdress
     *
     * @return  self
     */
    public function setEmailAdress($emailAdress)
    {
        $this->emailAdress = $emailAdress;

        return $this;
    }

    /**
     * Get the value of uniqueEmailId
     */
    public function getUniqueEmailId()
    {
        return $this->uniqueEmailId;
    }

    /**
     * Set the value of uniqueEmailId
     *
     * @return  self
     */
    public function setUniqueEmailId($uniqueEmailId)
    {
        $this->uniqueEmailId = $uniqueEmailId;

        return $this;
    }

    /**
     * Get the value of contactId
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Set the value of contactId
     *
     * @return  self
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * Get the value of fullName
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set the value of fullName
     *
     * @return  self
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

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
     * Get the value of emailType
     */
    public function getEmailType()
    {
        return $this->emailType;
    }

    /**
     * Set the value of emailType
     *
     * @return  self
     */
    public function setEmailType($emailType)
    {
        $this->emailType = $emailType;

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
     * Get the value of unsubscribeReason
     */
    public function getUnsubscribeReason()
    {
        return $this->unsubscribeReason;
    }

    /**
     * Set the value of unsubscribeReason
     *
     * @return  self
     */
    public function setUnsubscribeReason($unsubscribeReason)
    {
        $this->unsubscribeReason = $unsubscribeReason;

        return $this;
    }

    /**
     * Get the value of consentToOneToOneMessaging
     */
    public function getConsentToOneToOneMessaging()
    {
        return $this->consentToOneToOneMessaging;
    }

    /**
     * Set the value of consentToOneToOneMessaging
     *
     * @return  self
     */
    public function setConsentToOneToOneMessaging($consentToOneToOneMessaging)
    {
        $this->consentToOneToOneMessaging = $consentToOneToOneMessaging;

        return $this;
    }

    /**
     * Get the value of mergeFields
     */
    public function getMergeFields()
    {
        return $this->mergeFields;
    }

    /**
     * Set the value of mergeFields
     *
     * @return  self
     */
    public function setMergeFields($mergeFields)
    {
        $this->mergeFields = $mergeFields;

        return $this;
    }

    /**
     * Get the value of interests
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Set the value of interests
     *
     * @return  self
     */
    public function setInterests($interests)
    {
        $this->interests = $interests;

        return $this;
    }

    /**
     * Get the value of stats
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * Set the value of stats
     *
     * @return  self
     */
    public function setStats($stats)
    {
        $this->stats = $stats;

        return $this;
    }

    /**
     * Get the value of ipSignup
     */
    public function getIpSignup()
    {
        return $this->ipSignup;
    }

    /**
     * Set the value of ipSignup
     *
     * @return  self
     */
    public function setIpSignup($ipSignup)
    {
        $this->ipSignup = $ipSignup;

        return $this;
    }

    /**
     * Get the value of ipOpt
     */
    public function getIpOpt()
    {
        return $this->ipOpt;
    }

    /**
     * Set the value of ipOpt
     *
     * @return  self
     */
    public function setIpOpt($ipOpt)
    {
        $this->ipOpt = $ipOpt;

        return $this;
    }

    /**
     * Get the value of timestampOpt
     */
    public function getTimestampOpt()
    {
        return $this->timestampOpt;
    }

    /**
     * Set the value of timestampOpt
     *
     * @return  self
     */
    public function setTimestampOpt($timestampOpt)
    {
        $this->timestampOpt = $timestampOpt;

        return $this;
    }

    /**
     * Get the value of memberRating
     */
    public function getMemberRating()
    {
        return $this->memberRating;
    }

    /**
     * Set the value of memberRating
     *
     * @return  self
     */
    public function setMemberRating($memberRating)
    {
        $this->memberRating = $memberRating;

        return $this;
    }

    /**
     * Get the value of lastChanged
     */
    public function getLastChanged()
    {
        return $this->lastChanged;
    }

    /**
     * Set the value of lastChanged
     *
     * @return  self
     */
    public function setLastChanged($lastChanged)
    {
        $this->lastChanged = $lastChanged;

        return $this;
    }

    /**
     * Get the value of language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set the value of language
     *
     * @return  self
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the value of vip
     */
    public function getVip()
    {
        return $this->vip;
    }

    /**
     * Set the value of vip
     *
     * @return  self
     */
    public function setVip($vip)
    {
        $this->vip = $vip;

        return $this;
    }

    /**
     * Get the value of emailClient
     */
    public function getEmailClient()
    {
        return $this->emailClient;
    }

    /**
     * Set the value of emailClient
     *
     * @return  self
     */
    public function setEmailClient($emailClient)
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    /**
     * Get the value of location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of marketingPermissions
     */
    public function getMarketingPermissions()
    {
        return $this->marketingPermissions;
    }

    /**
     * Set the value of marketingPermissions
     *
     * @return  self
     */
    public function setMarketingPermissions($marketingPermissions)
    {
        $this->marketingPermissions = $marketingPermissions;

        return $this;
    }

    /**
     * Get the value of lastNote
     */
    public function getLastNote()
    {
        return $this->lastNote;
    }

    /**
     * Set the value of lastNote
     *
     * @return  self
     */
    public function setLastNote($lastNote)
    {
        $this->lastNote = $lastNote;

        return $this;
    }

    /**
     * Get the value of source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set the value of source
     *
     * @return  self
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get the value of tagsCount
     */
    public function getTagsCount()
    {
        return $this->tagsCount;
    }

    /**
     * Set the value of tagsCount
     *
     * @return  self
     */
    public function setTagsCount($tagsCount)
    {
        $this->tagsCount = $tagsCount;

        return $this;
    }

    /**
     * Get the value of tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get the value of listId
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * Set the value of listId
     *
     * @return  self
     */
    public function setListId($listId)
    {
        $this->listId = $listId;

        return $this;
    }
}

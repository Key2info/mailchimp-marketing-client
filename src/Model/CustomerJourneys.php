<?php

namespace ADB\MailchimpMarketingClient\Model;

class CustomerJourneys
{
    protected $journeyId;

    protected $stepId;

    public function getJourneyId()
    {
        return $this->journeyId;
    }

    public function setJourneyId(string $journeyId)
    {
        $this->journeyId = $journeyId;

        return $this;
    }

    public function getStepId()
    {
        return $this->stepId;
    }

    public function setStepId(string $stepId)
    {
        $this->stepId = $stepId;

        return $this;
    }
}

<?php

namespace ADB\MailchimpMarketingClient\Api;

use ADB\MailchimpMarketingClient\Api\MailchimpApi;
use ADB\MailchimpMarketingClient\Model\CustomerJourneys;

class CustomerJourneysApi extends MailchimpApi
{
    public function trigger(CustomerJourneys $customerJourney, $journeyId, $stepId)
    {
        $customerJourney->setJourneyId($journeyId);
        $customerJourney->setStepId($stepId);

        return $this->createResource('/customer-journeys/journeys/{journey_id}/steps/{step_id}/actions/trigger', $customerJourney);
    }
}

<?php

use League\Event\ListenerRegistry;
include_once __DIR__ . '/../Listeners/SendApplicationCreatedMail.php';
include_once __DIR__ . '/../Listeners/SendDealStatusUpdatedMail.php';
include_once __DIR__ . '/../Events/ApplicationWasCreated.php';
include_once __DIR__ . '/../Events/DealStatusUpdated.php';


class EventServiceProvider implements League\Event\ListenerSubscriber
{
    public function subscribeListeners(ListenerRegistry $acceptor): void
    {
        $acceptor->subscribeTo(ApplicationWasCreated::class, new SendApplicationCreatedMail());
        $acceptor->subscribeTo(DealStatusUpdated::class, new SendDealStatusUpdatedMail());
    }
}

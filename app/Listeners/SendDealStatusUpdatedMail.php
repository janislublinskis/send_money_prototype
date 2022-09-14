<?php

include_once __DIR__ . '/../Events/DealStatusUpdated.php';
include_once __DIR__ . '/../Http/Mail/DealStatusUpdatedMail.php';

use League\Event\Listener;

class SendDealStatusUpdatedMail implements Listener
{
    /* @param object|DealStatusUpdated $event */
    public function __invoke($event): void
    {
        (new DealStatusUpdatedMail())->sendEmail($event->getEmail());
    }
}
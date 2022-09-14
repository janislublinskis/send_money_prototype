<?php

include_once __DIR__ . '/../Events/ApplicationWasCreated.php';
include_once __DIR__ . '/../Http/Mail/ApplicationWasCreatedMail.php';

use League\Event\Listener;

class SendApplicationCreatedMail implements Listener
{
    /* @param object|ApplicationWasCreated $event */
    public function __invoke($event): void
    {
        (new ApplicationWasCreatedMail())->sendEmail($event->getEmail());
    }
}
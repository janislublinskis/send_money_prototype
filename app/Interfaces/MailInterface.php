<?php

interface MailInterface
{
    public function sendEmail(string $email): void;
}

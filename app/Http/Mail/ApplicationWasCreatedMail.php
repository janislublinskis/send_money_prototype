<?php

include_once __DIR__ . '/Mail.php';

class ApplicationWasCreatedMail extends Mail
{
    public function sendEmail(string $email): void
    {
        //Recipients
        $this->mailer->setFrom('application@prototypetest.com', 'Prototype');
        $this->mailer->addAddress($email);

        //Content
        $this->mailer->isHTML(true);
        $this->mailer->Subject = 'New application';
        $this->mailer->Body = 'New application received';
        $this->mailer->AltBody = 'New application received';

        $this->mailer->send();
    }
}

<?php

include_once __DIR__ . '/Mail.php';

class DealStatusUpdatedMail extends Mail
{
    public function sendEmail(string $email): void
    {
        //Recipients
        $this->mailer->setFrom('deal@prototypetest.com', 'Prototype');
        $this->mailer->addAddress($email);

        //Content
        $this->mailer->isHTML(true);
        $this->mailer->Subject = 'Application has been reviewed';
        $this->mailer->Body = 'Application has been reviewed';
        $this->mailer->AltBody = 'Application has been reviewed';

        $this->mailer->send();
    }
}

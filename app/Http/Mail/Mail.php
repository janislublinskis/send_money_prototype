<?php

include_once __DIR__ . '/../../Interfaces/MailInterface.php';

use PHPMailer\PHPMailer\PHPMailer;

//Load composer's autoloader
require 'vendor/autoload.php';

class Mail implements MailInterface
{
    public function __construct()
    {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Host = MAIL_HOST;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Port = MAIL_PORT;
        $this->mailer->Username = MAIL_USERNAME;
        $this->mailer->Password = MAIL_PASSWORD;
    }

    public function sendEmail(string $email): void
    {
        // TODO: Implement sendEmail() method.
    }
}

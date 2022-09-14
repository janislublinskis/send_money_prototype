<?php

use League\Event\EventDispatcher;
use Psr\Log\LoggerInterface;

include_once __DIR__ . '/../../Models/PartnerA.php';
include_once __DIR__ . '/../../Models/PartnerB.php';
include_once __DIR__ . '/../../Events/ApplicationWasCreated.php';

class ApplicationController
{
    /* @property PDO $conn */
    private $conn;

    /* @property LoggerInterface $conn */
    private $logger;

    public function __construct(Database $database, LoggerInterface $logger = null)
    {
        $this->conn = $database->getConnection();
        $this->logger = $logger;
    }

    public function create(): void
    {
        if (isset($_POST['email'])) {
            $email = htmlspecialchars(strip_tags($_POST['email']));
        }
        if (isset($_POST['money_amount'])) {
            $moneyAmount = htmlspecialchars(strip_tags($_POST['money_amount']));
        }

        $sql = "INSERT INTO applications (email, money_amount) VALUES (:email, :money_amount)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":money_amount", $moneyAmount, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            $this->logger->debug(join(', ', $stmt->errorInfo()));
            echo "<div class='alert alert-danger'>Unable to send application.</div>";
            return;
        }

        $this->createDeal($moneyAmount);
        $this->sendNotification();
        echo "<div class='alert alert-success'>Application was sent.</div>";
    }

    private function createDeal(int $moneyAmount): void
    {
        $partnerClass = 'Partner' . ($moneyAmount > 5000 ? 'A' : 'B');
        $partner = new $partnerClass($this->conn);
        $partner->createDeal($this->conn->lastInsertId());
    }

    private function sendNotification(): void
    {
        $dispatcher = new EventDispatcher();
        $dispatcher->subscribeTo(ApplicationWasCreated::class, new SendApplicationCreatedMail());
        $dispatcher->dispatch(new ApplicationWasCreated('partner@email.com'));
    }
}

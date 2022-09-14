<?php

use League\Event\EventDispatcher;
use Psr\Log\LoggerInterface;

include_once __DIR__ . '/../../Events/DealStatusUpdated.php';

class DealController
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

    public function updateDealStatus(): void
    {
        $dealId = (int)$_GET['id'];
        //Deal update query
        $sql = "UPDATE deals SET status = 'offer' WHERE id = '$dealId'";

        $stmt = $this->conn->query($sql);

        //Application get query
        $sql = "SELECT email FROM applications WHERE id IN (SELECT application_id FROM deals WHERE id = '$dealId')";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $email = join(',', $stmt->fetch(PDO::FETCH_ASSOC));
            $this->sendNotification($email);
        } else {
            $this->logger->debug(join(', ', $stmt->errorInfo()));
        }
    }

    private function sendNotification(string $email): void
    {
        $dispatcher = new EventDispatcher();
        $dispatcher->subscribeTo(DealStatusUpdated::class, new SendDealStatusUpdatedMail());
        $dispatcher->dispatch(new DealStatusUpdated($email));
    }
}

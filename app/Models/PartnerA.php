<?php

use Psr\Log\LoggerInterface;

include_once __DIR__ . '/../Interfaces/PartnerInterface.php';

class PartnerA implements PartnerInterface
{
    /* @property PDO $conn */
    private $conn;

    /* @property LoggerInterface $logger */
    private $logger;

    public function __construct(PDO $conn, LoggerInterface $logger = null)
    {
        $this->conn = $conn;
        $this->logger = $logger;
    }

    public function createDeal(int $applicationId): void
    {
        try {
            $sql = "INSERT INTO deals (application_id, partner) VALUES ($applicationId, 'A')";
            $this->conn->prepare($sql)->execute();
        } catch (Exception $e) {
            $this->logger->debug(join(', ', $stmt->errorInfo()));
        }
    }
}

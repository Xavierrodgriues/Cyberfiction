<?php

namespace PHPMaker2024\project1;

use Symfony\Component\EventDispatcher\GenericEvent;
use Doctrine\DBAL\Connection;

/**
 * Database Connected Event
 */
class DatabaseConnectedEvent extends GenericEvent
{
    public const NAME = "database.connected";

    public function getConnection(): Connection
    {
        return $this->subject;
    }
}
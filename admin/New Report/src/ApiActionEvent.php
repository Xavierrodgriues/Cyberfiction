<?php

namespace PHPMaker2024\project4;

use Symfony\Component\EventDispatcher\GenericEvent;
use Slim\App;

/**
 * API Action Event
 */
class ApiActionEvent extends GenericEvent
{
    public const NAME = "api.action";

    public function getApp(): App
    {
        return $this->subject;
    }
}

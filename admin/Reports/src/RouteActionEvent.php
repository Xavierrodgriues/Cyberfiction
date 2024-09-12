<?php

namespace PHPMaker2024\project4;

use Symfony\Component\EventDispatcher\GenericEvent;
use Slim\App;

/**
 * Routes Event
 */
class RouteActionEvent extends GenericEvent
{
    public const NAME = "route.action";

    public function getApp(): App
    {
        return $this->subject;
    }
}

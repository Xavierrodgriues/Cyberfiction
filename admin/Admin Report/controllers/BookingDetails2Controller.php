<?php

namespace PHPMaker2024\project6;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\project6\Attributes\Delete;
use PHPMaker2024\project6\Attributes\Get;
use PHPMaker2024\project6\Attributes\Map;
use PHPMaker2024\project6\Attributes\Options;
use PHPMaker2024\project6\Attributes\Patch;
use PHPMaker2024\project6\Attributes\Post;
use PHPMaker2024\project6\Attributes\Put;

class BookingDetails2Controller extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/BookingDetails2List", [PermissionMiddleware::class], "list.booking_details2")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BookingDetails2List");
    }
}

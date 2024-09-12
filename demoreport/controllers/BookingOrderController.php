<?php

namespace PHPMaker2024\project1;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\project1\Attributes\Delete;
use PHPMaker2024\project1\Attributes\Get;
use PHPMaker2024\project1\Attributes\Map;
use PHPMaker2024\project1\Attributes\Options;
use PHPMaker2024\project1\Attributes\Patch;
use PHPMaker2024\project1\Attributes\Post;
use PHPMaker2024\project1\Attributes\Put;

class BookingOrderController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/BookingOrderList", [PermissionMiddleware::class], "list.booking_order")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BookingOrderList");
    }
}
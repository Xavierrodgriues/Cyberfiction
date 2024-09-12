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

class BookingorderReportController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/BookingorderReportList", [PermissionMiddleware::class], "list.bookingorder_report")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "BookingorderReportList");
    }
}

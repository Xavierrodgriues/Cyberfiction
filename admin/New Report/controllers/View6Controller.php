<?php

namespace PHPMaker2024\project4;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\project4\Attributes\Delete;
use PHPMaker2024\project4\Attributes\Get;
use PHPMaker2024\project4\Attributes\Map;
use PHPMaker2024\project4\Attributes\Options;
use PHPMaker2024\project4\Attributes\Patch;
use PHPMaker2024\project4\Attributes\Post;
use PHPMaker2024\project4\Attributes\Put;

class View6Controller extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/View6List", [PermissionMiddleware::class], "list.view6")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "View6List");
    }
}
<?php

namespace PHPMaker2024\project3;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\project3\Attributes\Delete;
use PHPMaker2024\project3\Attributes\Get;
use PHPMaker2024\project3\Attributes\Map;
use PHPMaker2024\project3\Attributes\Options;
use PHPMaker2024\project3\Attributes\Patch;
use PHPMaker2024\project3\Attributes\Post;
use PHPMaker2024\project3\Attributes\Put;

class View2Controller extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/View2List", [PermissionMiddleware::class], "list.view2")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "View2List");
    }
}

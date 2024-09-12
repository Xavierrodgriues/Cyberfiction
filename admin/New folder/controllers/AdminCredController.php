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

class AdminCredController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/AdminCredList[/{sr_no}]", [PermissionMiddleware::class], "list.admin_cred")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AdminCredList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/AdminCredAdd[/{sr_no}]", [PermissionMiddleware::class], "add.admin_cred")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AdminCredAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/AdminCredView[/{sr_no}]", [PermissionMiddleware::class], "view.admin_cred")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AdminCredView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/AdminCredEdit[/{sr_no}]", [PermissionMiddleware::class], "edit.admin_cred")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AdminCredEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/AdminCredDelete[/{sr_no}]", [PermissionMiddleware::class], "delete.admin_cred")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AdminCredDelete");
    }
}

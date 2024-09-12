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

class MainCourseItemController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MainCourseItemList[/{id}]", [PermissionMiddleware::class], "list.main_course_item")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MainCourseItemList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MainCourseItemAdd[/{id}]", [PermissionMiddleware::class], "add.main_course_item")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MainCourseItemAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MainCourseItemView[/{id}]", [PermissionMiddleware::class], "view.main_course_item")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MainCourseItemView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MainCourseItemEdit[/{id}]", [PermissionMiddleware::class], "edit.main_course_item")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MainCourseItemEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MainCourseItemDelete[/{id}]", [PermissionMiddleware::class], "delete.main_course_item")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MainCourseItemDelete");
    }
}

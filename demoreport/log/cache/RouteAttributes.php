<?php return \Symfony\Component\VarExporter\Internal\Hydrator::hydrate(
    $o = [
        clone (($p = &\Symfony\Component\VarExporter\Internal\Registry::$prototypes)['PHPMaker2024\\project1\\Attributes\\Map'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project1\\Attributes\\Map')),
        clone ($p['PHPMaker2024\\project1\\Attributes\\Get'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project1\\Attributes\\Get')),
        clone $p['PHPMaker2024\\project1\\Attributes\\Get'],
        clone $p['PHPMaker2024\\project1\\Attributes\\Map'],
        clone $p['PHPMaker2024\\project1\\Attributes\\Map'],
    ],
    null,
    [
        'PHPMaker2024\\project1\\Attributes\\Map' => [
            'methods' => [
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                ],
                [
                    'GET',
                ],
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
            ],
            'pattern' => [
                '/BookingOrderList',
                '/swagger/swagger',
                '/[index]',
                '/RoomsList',
                '/View1List',
            ],
            'handler' => [
                'PHPMaker2024\\project1\\BookingOrderController:list',
                'PHPMaker2024\\project1\\OthersController:swagger',
                'PHPMaker2024\\project1\\OthersController:index',
                'PHPMaker2024\\project1\\RoomsController:list',
                'PHPMaker2024\\project1\\View1Controller:list',
            ],
            'middleware' => [
                [
                    'PHPMaker2024\\project1\\PermissionMiddleware',
                ],
                [],
                [
                    'PHPMaker2024\\project1\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project1\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project1\\PermissionMiddleware',
                ],
            ],
            'name' => [
                'list.booking_order',
                'swagger',
                'index',
                'list.rooms',
                'list.view1',
            ],
            'options' => [
                [],
                [],
                [],
                [],
                [],
            ],
        ],
    ],
    [
        $o[0],
        $o[1],
        $o[2],
        $o[3],
        $o[4],
    ],
    []
);
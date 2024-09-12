<?php return \Symfony\Component\VarExporter\Internal\Hydrator::hydrate(
    $o = [
        clone (($p = &\Symfony\Component\VarExporter\Internal\Registry::$prototypes)['PHPMaker2024\\project1\\Attributes\\Map'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project1\\Attributes\\Map')),
        clone ($p['PHPMaker2024\\project1\\Attributes\\Get'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project1\\Attributes\\Get')),
        clone $p['PHPMaker2024\\project1\\Attributes\\Get'],
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
            ],
            'pattern' => [
                '/BookingorderReportList',
                '/swagger/swagger',
                '/[index]',
            ],
            'handler' => [
                'PHPMaker2024\\project1\\BookingorderReportController:list',
                'PHPMaker2024\\project1\\OthersController:swagger',
                'PHPMaker2024\\project1\\OthersController:index',
            ],
            'middleware' => [
                [
                    'PHPMaker2024\\project1\\PermissionMiddleware',
                ],
                [],
                [
                    'PHPMaker2024\\project1\\PermissionMiddleware',
                ],
            ],
            'name' => [
                'list.bookingorder_report',
                'swagger',
                'index',
            ],
            'options' => [
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
    ],
    []
);
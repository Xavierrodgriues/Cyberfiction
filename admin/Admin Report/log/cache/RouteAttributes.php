<?php return \Symfony\Component\VarExporter\Internal\Hydrator::hydrate(
    $o = [
        clone (($p = &\Symfony\Component\VarExporter\Internal\Registry::$prototypes)['PHPMaker2024\\project6\\Attributes\\Map'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project6\\Attributes\\Map')),
        clone $p['PHPMaker2024\\project6\\Attributes\\Map'],
        clone ($p['PHPMaker2024\\project6\\Attributes\\Get'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project6\\Attributes\\Get')),
        clone $p['PHPMaker2024\\project6\\Attributes\\Get'],
        clone $p['PHPMaker2024\\project6\\Attributes\\Map'],
    ],
    null,
    [
        'PHPMaker2024\\project6\\Attributes\\Map' => [
            'methods' => [
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
            ],
            'pattern' => [
                '/BookingDetails2List',
                '/HallReportList',
                '/swagger/swagger',
                '/[index]',
                '/UserReportList',
            ],
            'handler' => [
                'PHPMaker2024\\project6\\BookingDetails2Controller:list',
                'PHPMaker2024\\project6\\HallReportController:list',
                'PHPMaker2024\\project6\\OthersController:swagger',
                'PHPMaker2024\\project6\\OthersController:index',
                'PHPMaker2024\\project6\\UserReportController:list',
            ],
            'middleware' => [
                [
                    'PHPMaker2024\\project6\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project6\\PermissionMiddleware',
                ],
                [],
                [
                    'PHPMaker2024\\project6\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project6\\PermissionMiddleware',
                ],
            ],
            'name' => [
                'list.booking_details2',
                'list.hall_report',
                'swagger',
                'index',
                'list.user_report',
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
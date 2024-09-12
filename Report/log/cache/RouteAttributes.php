<?php return \Symfony\Component\VarExporter\Internal\Hydrator::hydrate(
    $o = [
        clone (($p = &\Symfony\Component\VarExporter\Internal\Registry::$prototypes)['PHPMaker2024\\project2\\Attributes\\Map'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project2\\Attributes\\Map')),
        clone $p['PHPMaker2024\\project2\\Attributes\\Map'],
        clone $p['PHPMaker2024\\project2\\Attributes\\Map'],
        clone $p['PHPMaker2024\\project2\\Attributes\\Map'],
        clone ($p['PHPMaker2024\\project2\\Attributes\\Get'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project2\\Attributes\\Get')),
        clone $p['PHPMaker2024\\project2\\Attributes\\Get'],
    ],
    null,
    [
        'PHPMaker2024\\project2\\Attributes\\Map' => [
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
            ],
            'pattern' => [
                '/BookingDetailsList',
                '/BookingOrderList',
                '/BookingorderReportList',
                '/BookingRecordsList',
                '/swagger/swagger',
                '/[index]',
            ],
            'handler' => [
                'PHPMaker2024\\project2\\BookingDetailsController:list',
                'PHPMaker2024\\project2\\BookingOrderController:list',
                'PHPMaker2024\\project2\\BookingorderReportController:list',
                'PHPMaker2024\\project2\\BookingRecordsController:list',
                'PHPMaker2024\\project2\\OthersController:swagger',
                'PHPMaker2024\\project2\\OthersController:index',
            ],
            'middleware' => [
                [
                    'PHPMaker2024\\project2\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project2\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project2\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project2\\PermissionMiddleware',
                ],
                [],
                [
                    'PHPMaker2024\\project2\\PermissionMiddleware',
                ],
            ],
            'name' => [
                'list.booking_details',
                'list.booking_order',
                'list.bookingorder_report',
                'list.booking_records',
                'swagger',
                'index',
            ],
            'options' => [
                [],
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
        $o[5],
    ],
    []
);
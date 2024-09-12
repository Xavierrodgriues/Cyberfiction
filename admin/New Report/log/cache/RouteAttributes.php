<?php return \Symfony\Component\VarExporter\Internal\Hydrator::hydrate(
    $o = [
        clone (($p = &\Symfony\Component\VarExporter\Internal\Registry::$prototypes)['PHPMaker2024\\project4\\Attributes\\Get'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project4\\Attributes\\Get')),
        clone $p['PHPMaker2024\\project4\\Attributes\\Get'],
        clone ($p['PHPMaker2024\\project4\\Attributes\\Map'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project4\\Attributes\\Map')),
        clone $p['PHPMaker2024\\project4\\Attributes\\Map'],
        clone $p['PHPMaker2024\\project4\\Attributes\\Map'],
    ],
    null,
    [
        'PHPMaker2024\\project4\\Attributes\\Map' => [
            'methods' => [
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
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
            ],
            'pattern' => [
                '/swagger/swagger',
                '/[index]',
                '/View3List',
                '/View4List',
                '/View6List',
            ],
            'handler' => [
                'PHPMaker2024\\project4\\OthersController:swagger',
                'PHPMaker2024\\project4\\OthersController:index',
                'PHPMaker2024\\project4\\View3Controller:list',
                'PHPMaker2024\\project4\\View4Controller:list',
                'PHPMaker2024\\project4\\View6Controller:list',
            ],
            'middleware' => [
                [],
                [
                    'PHPMaker2024\\project4\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project4\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project4\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project4\\PermissionMiddleware',
                ],
            ],
            'name' => [
                'swagger',
                'index',
                'list.view3',
                'list.view4',
                'list.view6',
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
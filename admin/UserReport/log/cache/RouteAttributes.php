<?php return \Symfony\Component\VarExporter\Internal\Hydrator::hydrate(
    $o = [
        clone (($p = &\Symfony\Component\VarExporter\Internal\Registry::$prototypes)['PHPMaker2024\\project3\\Attributes\\Get'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project3\\Attributes\\Get')),
        clone $p['PHPMaker2024\\project3\\Attributes\\Get'],
        clone ($p['PHPMaker2024\\project3\\Attributes\\Map'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\project3\\Attributes\\Map')),
    ],
    null,
    [
        'PHPMaker2024\\project3\\Attributes\\Map' => [
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
            ],
            'pattern' => [
                '/swagger/swagger',
                '/[index]',
                '/View2List',
            ],
            'handler' => [
                'PHPMaker2024\\project3\\OthersController:swagger',
                'PHPMaker2024\\project3\\OthersController:index',
                'PHPMaker2024\\project3\\View2Controller:list',
            ],
            'middleware' => [
                [],
                [
                    'PHPMaker2024\\project3\\PermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\project3\\PermissionMiddleware',
                ],
            ],
            'name' => [
                'swagger',
                'index',
                'list.view2',
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
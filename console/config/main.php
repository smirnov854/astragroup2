<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'options' => [ // различные настройки
            'class' => 'common\components\OptionsComponent',
        ],
        'CbRF' => [
            'class' => 'microinginer\CbRFRates\CBRF',
            'defaultCurrency' => "USD"
        ],
//        'request' => [
//            'parsers' => [
//                'text/xml' => 'light\yii2\XmlParser',
//                'application/xml' => 'light\yii2\XmlParser',
//            ],
//        ],
        'plApi' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://booking.stpeterline.com:8870/vxapi/ws/vxapi.wsdl',
            'options' => [
                "exceptions" => 0
            ],
        ]
    ],
    'params' => $params,
];

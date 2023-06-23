<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
    'bootstrap' => ['debug'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['84.204.33.99', '5.18.211.107', '127.0.0.1', '::1']
        ]
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '/',
            'rules' => [
                '/search' => 'search/index',
                '/ship' => 'ship/index',
                '/ship/<id:\d+>' => 'ship/detail',
                '/news/<id:\d+>' => 'news/detail',
                '/news' => 'news/index',
                '/company/<id:\d+>' => 'company/detail',
                '/company' => 'company/index',
                '/spb' => 'spb/index',
                '/contacts' => 'contact/index',
                '/cruise/<id:\d+>' => 'cruise/detail',
                '/order/create' => 'order/create',
                '/<alias:[\w-]+>' => 'page/view/',

            ],
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                // 'host' => 'ssl://smtp.yandex.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'site_message@astartagroup.ru',
                'password' => '',
                // 'port' => '465', // Port 25 is a very common port too
                // 'encryption' => 'SSL', // It is often used, check your provider or mail server specs
                'port' => '465', // Port 25 is a very common port too
                'encryption' => 'SSL', // It is often used, check your provider or mail server specs

            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'options' => [ // различные настройки
            'class' => 'common\components\OptionsComponent',
        ],
        'yandexMapsApi' => [
            'class' => 'mirocow\yandexmaps\Api',
        ]
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'on beforeRequest' => function () {
        $pathInfo = Yii::$app->request->pathInfo;
        // var_dump($pathInfo); die;
        if (!empty($pathInfo) && substr($pathInfo, -1) !== '/') {
            Yii::$app->response->redirect(rtrim($pathInfo) . '/')->send();
        }
    },
    'params' => $params,
];

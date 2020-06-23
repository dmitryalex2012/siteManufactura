<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'zibaVLZ6zlMPdRGOMV2-SBwkbavdOAOH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
//            'useFileTransport' => true,

            'useFileTransport' => false,
//                    'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'tpmfd27@gmail.com',
                'password' => 'oapvrqlwrfksbcay',
                'port' => '587',
                'encryption' => 'tls',
                'streamOptions' => ['ssl' => ['allow_self_signed' => true, 'verify_peer' => false, 'verify_peer_name' => false,],]
            ],

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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                'login' => 'site/login',
//                'about' => 'site/about',
//                'contact' => 'site/contact',
            ],
        ],

        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
//            'siteKey' => '6LcZT6YZAAAAAGlTcbM1oXVHDNboHhmbwVhnhnBY',      // v3 for http://www.designburoshtor.website/
//            'secret' => '6LcZT6YZAAAAAJWT5oQwDMWSBFvqT6kIsESBszWO',       // v3 for http://www.designburoshtor.website/
//            'siteKey' => '6Le5gagZAAAAAC0iqMNpb1G7GcAZjqOsO-arp8jP',      // v2 for http://www.designburoshtor.website/
//            'secret' => '6Le5gagZAAAAAPo4phWXR7XRg-YWvjgO6Eq4NBZy',       // v2 for http://www.designburoshtor.website/
//            'siteKey' => '6LeVU6YZAAAAAB7GPQ99rDkx03F3-SwB6B1XjMbi',      // v3 for fw0308.loc
//            'secret' => '6LeVU6YZAAAAAC6wvEZFMiyU85lPf7mEIPGLc3e7',       // v3 for fw0308.loc
            'siteKey' => '6Lc-VKYZAAAAADMXy0se_2qRN6t442GoV8aHBrVS',        // v2 for fw0308.loc
            'secret' => '6Lc-VKYZAAAAADzlOjaP0sPnafw221YJ1lb70FAl',         // v2 for fw0308.loc
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment

//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',

    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1'],

//    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

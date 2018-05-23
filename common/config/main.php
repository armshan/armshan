<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [
                'posts' => 'post/index',
                'post/<id:\d+>' => 'post/view',
                '<controller:(post|comment)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete',
                'http://<user:\w+>.digpage.com/<lang:\w+>/profile' => 'user/profile',
            ],
        ],
    ],
];

<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
         // 'dsn' => 'sqlsrv:Server=10.110.30.9;Database=jw_weixin', //pdo_sqlser 方式 windows连接
         // 'dsn' => 'sqlsrv:Server=sqlserver.rdssdgjv3k5uoz7.rds.bj.baidubce.com;Database=jw_weixin', //pdo_sqlser 方式 windows连接
         // 'dsn' => 'dblib:host=sqlserver.rdssdgjv3k5uoz7.rds.bj.baidubce.com;dbname=jw_weixin', //pdo_dblib 方式 linux连接
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                //'host' => 'pop.163.com',
                'host' => 'smtp.163.com',
                // 'host' => 'imap.163.com',
                //'host' => 'smtp.126.com',
                'username' => 'armshan@163.com',
                'password' => 'ROOTHAN2',
                'port' => '25',
                'encryption' => 'tls',
            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['armshan@163.com'=>'程序员韩']
            ],
        ],
    ],
];

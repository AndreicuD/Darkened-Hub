<?php
return [
    'sourceLanguage' => 'en',
    'language' => 'ro',
    'timeZone' => 'Europe/Bucharest',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
        ],
        'i18n' => [
            'translations' => [
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'sourceLanguage' => 'en-US',
                    'basePath' => '@app/translations'
                ],
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'kv*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'kvgrid' => 'kvgrid.php',
                    ],
                ],
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd/M/Y',
            'datetimeFormat' => 'dd/M/Y H:mm',
            'timeFormat' => 'H:mm',
            'locale' => 'ro', //your language locale
            'defaultTimeZone' => 'Europe/Bucharest', // time zone
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'RON',
        ],
    ],
];

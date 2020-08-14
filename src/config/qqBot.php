<?php

return [

    'default' => env('QQ_ENGINE', 'mirai'),
    'engines' => [
        'mirai' => [

        ],

        'cq' => [
            'transport' => 'ses',
        ],
    ],
    'report_url' =>  env('REPORT_URL', 'http://jxh-mirai:8881'),
    "authkey"=> env('authkey', '121312123'),
    'botQQ'=>env('botQQ'),
    'master' => env('masterQQ'),
];

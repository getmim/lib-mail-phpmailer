<?php

return [
    '__name' => 'lib-mail-phpmailer',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/lib-mail-phpmailer.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'https://iqbalfn.com/'
    ],
    '__files' => [
        'modules/lib-mail-phpmailer' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-mail' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'LibMailPhpmailer\\Library' => [
                'type' => 'file',
                'base' => 'modules/lib-mail-phpmailer/library'
            ],
            'PHPMailer\\PHPMailer' => [
                'type' => 'file',
                'base' => 'modules/lib-mail-phpmailer/third-party/PHPMailer'
            ]
        ],
        'files' => []
    ],
    'libMail' => [
        'handler' => 'LibMailPhpmailer\\Library\\Sender'
    ],
    'libMailPhpMailer' => [
        'SMTP'          => true,
        'Host'          => 'smtp.gmail.com',
        'SMTPAuth'      => true,
        'SMTPSecure'    => 'tls',
        'Port'          => 587
    ]
];
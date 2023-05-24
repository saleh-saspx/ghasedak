<?php
return [
    'default_sms_sender' => 'faraz_sms',
    'sms_maper' => [
        'faraz_sms' => [
            'map' => \Saspx\IranianSmsProviderPhp\src\Drivers\FarazSMS::class,
            'API_KEY' => env('FARAZ_SMS_API_KEY'),
            'SMS_OTP_VARIABLE_KEY' => env('FARAZ_SMS_OTP_VARIABLE_KEY'),
            'OTP_VARIABLE_PATTERN' => env('FARAZ_SMS_OTP_VARIABLE_PATTERN'),
            'SENDER_NUMBER' => env('FARAZ_SMS_SENDER_NUMBER'),
        ]
    ]
];

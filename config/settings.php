<?php

return [
    'JWT2LIVEMIN' => env('JWT2LIVEMIN', 10),
    'JWT_FOREVER' => env('JWT_FOREVER', 525600),
    'JWT2RFSHMIN' => env('JWT2RFSHMIN', 60),
    'JWTACTIVATION' => env('JWTACTIVATION', 10800),
    'JWT_TTL_INVITATION' => env('JWT_TTL_INVITATION', 10800),
    'JWT_TTL_PWD_RECOVERY' => env('JWT_TTL_PWD_RECOVERY', 10800),

    'avatar_path' => '/images/avatar/'
];
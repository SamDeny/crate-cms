<?php declare(strict_types=1);

return [

    'session' => [
        'name'      => env('CRATE_APP', 'unconfigured_crate_app'),
        'lifetime'  => 0,
        'path'      => '/',
        'domain'    => env('CRATE_URL', 'localhost'),
        'secure'    => env('FORCE_HTTPS', false),
        'httponly'  => true,
        'samesite'  => 'Strict'
    ],

];

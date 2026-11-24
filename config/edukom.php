<?php

return [

    /*
    | Penguncian akun setelah login gagal berturut-turut (T0.1, SEC-02).
    */
    'auth' => [
        'max_failed_attempts' => 5,
        'lock_minutes' => 15,
        'login_rate_per_minute' => 10,
    ],

    /*
    | Password akun bawaan untuk DatabaseSeeder (hanya APP_ENV=local).
    */
    'seed' => [
        'owner_password' => env('SEED_OWNER_PASSWORD'),
        'admin_password' => env('SEED_ADMIN_PASSWORD'),
    ],

];

<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
| Feature test memakai DB dari .env (db_edukom). RefreshDatabase menjalankan
| migrate:fresh sekali per proses lalu membungkus setiap test dalam transaksi.
*/
pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Feature');

pest()->extend(TestCase::class)->in('Unit');

/**
 * Header permintaan SPA: Referer dari domain stateful agar Sanctum memakai sesi.
 *
 * @return array<string, string>
 */
function spaHeaders(): array
{
    return [
        'Accept' => 'application/json',
        'Referer' => 'http://localhost',
    ];
}

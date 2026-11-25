<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function createApplication()
    {
        $app = parent::createApplication();

        // Tabel khusus test (misalnya test_versions) ikut dibuat oleh migrate:fresh.
        $app->make('migrator')->path(base_path('tests/database/migrations'));

        return $app;
    }
}

<?php

namespace Tests;

use Hash;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

/**
 * Class TestCase
 *
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{

    use DatabaseMigrations;

    /**
     * @return mixed
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        Hash::setRounds(4);

        return $app;
    }

    protected function setUp(): void
    {
        if (file_exists(__DIR__ . '/../bootstrap/cache/config.php')) {
            unlink(__DIR__ . '/../bootstrap/cache/config.php');
        }

        parent::setUp();
        $this->prepareForTests();
        $this->withoutMiddleware(\App\Http\Middleware\Cors::class);
    }

    private function prepareForTests()
    {
        \Config::set('migrations.default.directory', database_path('migrations_test'));
        Artisan::call('doctrine:migrations:migrate');
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}

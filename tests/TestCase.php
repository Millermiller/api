<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;

    public function createApplication()
    {
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function setUp()
    {
        parent::setUp();
        $this->prepareForTests();
        $this->withoutMiddleware(\App\Http\Middleware\Cors::class);
    }
    private function prepareForTests()
    {
        Artisan::call('doctrine:migrations:migrate');
       // Artisan::call('db:seed');
    }
    public function tearDown()
    {
        parent::tearDown();
    }

}

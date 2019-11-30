<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\BrowserKitTesting\Concerns\InteractsWithPages;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, InteractsWithPages, DatabaseTransactions, MigrateFreshSeedOnce;

}

<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\BrowserKitTesting\Concerns\InteractsWithPages;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, InteractsWithPages;

}

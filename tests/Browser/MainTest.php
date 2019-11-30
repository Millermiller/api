<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MainTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testMainSite()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://scandinaver.local')
                    ->assertSee('Scandinaver');
        });
    }

    /**
     * @throws \Throwable
     */
    public function testMainLogged()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('https://scandinaver.local')
                ->assertSee('Выход');
        });
    }
}

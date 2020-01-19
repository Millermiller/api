<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubdomainTest extends DuskTestCase
{
    /**
     * @throws \Throwable
     */
    public function testSubdomain()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://is.scandinaver.local/#/login')
                ->assertSeeIn('span', 'Вход');
        });
    }

    /**
     * @throws \Throwable
     */
    public function testSubdomainLogged()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('https://is.scandinaver.local/#/learn')
                ->waitForText('выход', 1)
                ->assertSee( 'выход');
        });
    }
}

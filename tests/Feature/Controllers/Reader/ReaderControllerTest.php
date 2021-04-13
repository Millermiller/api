<?php

namespace Tests\Feature\Controllers\Reader;

use App\Http\Controllers\Reader\ReaderController;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

/**
 * Class ReaderControllerTest
 *
 * @package Tests\Feature\Controllers\Reader
 */
class ReaderControllerTest extends TestCase
{
    private User $user;

    private Language $language;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        $this->language = entity(Language::class)->create(['name' => 'is']);
    }

    /**
     * TODO: implement
     */
    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('read', [
            'language' => $this->language->getTitle(),
            'text' => 'hallo'
        ]));

        self::assertEquals(true, true);
    }
}

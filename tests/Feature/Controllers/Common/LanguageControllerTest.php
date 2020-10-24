<?php

namespace Tests\Feature\Controllers\Common;

use Scandinaver\Common\Domain\Model\Language;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{

    private int $languagesNumber = 2;

    protected function setUp(): void
    {
        parent::setUp();

        $languages = entity(Language::class, $this->languagesNumber)->create(['name' => 'is']);
    }

    public function testLanguages()
    {
        $response = $this->get(route('languages:all'));
        $decodedResponse = json_decode($response->getContent());

        self::assertCount($this->languagesNumber, $decodedResponse);

        $response->assertJsonStructure(
            [
                \Tests\Responses\Language::response(),
            ]
        );
    }
}

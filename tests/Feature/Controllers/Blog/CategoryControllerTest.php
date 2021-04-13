<?php

namespace Tests\Feature\Controllers\Blog;

use Illuminate\Http\JsonResponse;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

/**
 * Class CategoryControllerTest
 *
 * @package Tests\Feature\Controllers\Blog
 */
class CategoryControllerTest extends TestCase
{
    private int $categoryCount = 2;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();
        entity(Category::class, $this->categoryCount)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('category:all'));
        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->categoryCount, $decodedResponse);
        $response->assertJsonStructure(
            [
                [
                    'id',
                    'title',
                ],
            ]
        );
    }

    public function testShow()
    {
        $testCategoryId = 1;
        $response = $this->get(route('category:show', ['categoryId' => $testCategoryId]));
        $response->assertJsonStructure(
            [
                'id',
                'title',
            ]
        );
        $response->assertJsonFragment(
            [
                'id' => $testCategoryId,
            ]
        );
    }


    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $testCategoryName = 'TESTCATEGORY';

        $response = $this->post(route('category:create', ['title' => $testCategoryName]));

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(
            [
                'id',
                'title',
            ]
        );
        $response->assertJsonFragment(
            [
                'title' => $testCategoryName,
            ]
        );
    }

    public function testCreateDublicate()
    {
        $this->actingAs($this->user, 'api');

        $testCategoryName = 'TESTCATEGORY';

        $response = $this->post(route('category:create', ['title' => $testCategoryName]));

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response = $this->post(route('category:create', ['title' => $testCategoryName]));

        self::assertEquals(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $testCategoryName = 'TESTCATEGORY';
        $testCategoryId = 1;

        $response = $this->put(route('category:update', ['categoryId' => $testCategoryId]), ['title' => $testCategoryName]);

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
            [
                'id',
                'title',
            ]
        );
        $response->assertJsonFragment(
            [
                'title' => $testCategoryName,
            ]
        );
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $testCategoryId = 1;

        $response = $this->delete(route('category:delete', ['categoryId' => $testCategoryId]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());

        $response = $this->get(route('category:show', ['categoryId' => $testCategoryId]));

        self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}

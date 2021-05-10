<?php

namespace Tests\Feature\Controllers\Blog;

use Exception;
use Illuminate\Http\JsonResponse;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\RBAC\Domain\Model\Permission;
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

    /**
     * @throws Exception
     */
    public function testIndex()
    {
        $permission = new Permission(\Scandinaver\Blog\Domain\Permission\Category::VIEW);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('category:all'));
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

    /**
     * @throws Exception
     */
    public function testShow()
    {
        $permission = new Permission(\Scandinaver\Blog\Domain\Permission\Category::SHOW);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testCategoryId = 1;
        $response       = $this->get(route('category:show', ['categoryId' => $testCategoryId]));
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

    /**
     * @throws Exception
     */
    public function testStore()
    {
        $permission = new Permission(\Scandinaver\Blog\Domain\Permission\Category::CREATE);
        $this->user->allow($permission);
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

    /**
     * @throws Exception
     */
    public function testCreateDuplicate(): void
    {
        $permission = new Permission(\Scandinaver\Blog\Domain\Permission\Category::CREATE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testCategoryName = 'TESTCATEGORY';

        $response = $this->post(route('category:create', ['title' => $testCategoryName]));

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response = $this->post(route('category:create', ['title' => $testCategoryName]));

        self::assertEquals(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = new Permission(\Scandinaver\Blog\Domain\Permission\Category::UPDATE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testCategoryName = 'TESTCATEGORY';
        $testCategoryId   = 1;

        $response = $this->put(route('category:update', ['categoryId' => $testCategoryId]),
            ['title' => $testCategoryName]);

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

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = new Permission(\Scandinaver\Blog\Domain\Permission\Category::DELETE);
        $this->user->allow($permission);
        $permission = new Permission(\Scandinaver\Blog\Domain\Permission\Category::SHOW);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $testCategoryId = 1;

        $response = $this->delete(route('category:delete', ['categoryId' => $testCategoryId]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());

        $response = $this->get(route('category:show', ['categoryId' => $testCategoryId]));

        self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}

<?php

namespace Tests\Feature\Controllers\Blog;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\Blog\Domain\Entity\Category;
use Scandinaver\Blog\Domain\Entity\Post;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class PostControllerTest
 *
 * @package Tests\Feature\Controllers\Blog
 */
class PostControllerTest extends TestCase
{

    private User $user;

    private Category $category;

    private int $postCount = 2;

    private Collection $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class)->create();

        $this->category = entity(Category::class, 1)->create();

        $this->post = entity(Post::class, $this->postCount)->create(
            [
                'category' => $this->category,
                'user'     => $this->user,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\POST::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('post:all'));
        $decodedResponse = json_decode($response->getContent(), TRUE);

        self::assertCount($this->postCount, $decodedResponse);

        $response->assertJsonStructure(
                \Tests\Responses\PostCollection::response(),
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\POST::SHOW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testPostId = 1;
        $response   = $this->get(route('post:show', ['postId' => $testPostId]));

        $response->assertJsonStructure(
            \Tests\Responses\Post::response()
        );

        $response->assertJsonFragment(
            [
                'id' => (string)$testPostId,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\POST::CREATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $this->actingAs($this->user, 'api');

        $testPostContent = 'TESTCONTENT';
        $testPostTitle   = 'TESTTITLE';

        $response = $this->post(
            route('post:create'),
            [
                'category'       => $this->category->getId(),
                'status'         => 1,
                'title'          => $testPostTitle,
                'content'        => $testPostContent,
                'comment_status' => 1,
                'anonse'         => $testPostContent,
            ]
        );

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Post::response()
        );

        $response->assertJsonFragment(
            [
                'content' => $testPostContent,
                'title'   => $testPostTitle,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\POST::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testPostContent = 'TESTCONTENT';
        $testPostTitle   = 'TESTTITLE';
        $testPostAnonce  = 'TESTANONCE';

        $response = $this->put(
            route('post:update', ['postId' => $this->post->first()->getId()]),
            [
                'title'    => $testPostTitle,
                'content'  => $testPostContent,
                'category' => 1,
                'status'   => 1,
                'comment_status' => 1,
                'anonse'   => $testPostAnonce,
            ]
        );

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Post::response()
        );

        $response->assertJsonFragment(
            [
                'content' => $testPostContent,
                'title'   => $testPostTitle,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\POST::DELETE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('post:delete', ['postId' => $this->post->first()->getId()]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testUpload()
    {
        self::assertEquals(TRUE, TRUE);
    }
}

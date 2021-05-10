<?php

namespace Tests\Feature\Controllers\Blog;

use Exception;
use Illuminate\Http\JsonResponse;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

/**
 * Class CommentControllerTest
 *
 * @package Tests\Feature\Controllers\Blog
 */
class CommentControllerTest extends TestCase
{

    private int $commentCount = 2;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $category   = entity(Category::class, 1)->create();
        $post       = entity(Post::class, 1)->create([
            'category' => $category,
            'user'     => entity(User::class, 1)->create(),
        ]);
        $this->user = entity(User::class, 1)->create();

        entity(Comment::class, $this->commentCount)->create(['post' => $post, 'user' => $this->user]);
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\Comment::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('comment:all'));

        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->commentCount, $decodedResponse);
        $response->assertJsonStructure(
            [
                \Tests\Responses\Comment::response(),
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\Comment::SHOW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testCommentId = 1;
        $response      = $this->get(route('comment:show', ['commentId' => $testCommentId]));

        $response->assertJsonStructure(
            \Tests\Responses\Comment::response()
        );

        $response->assertJsonFragment(
            [
                'id' => $testCommentId,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\Comment::CREATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $commentText = 'testcommenttext';

        $response = $this->post(route('comment:create'),
            [
                'post_id' => 1,
                'text'    => $commentText,
            ]);

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Comment::response()
        );

        $response->assertJsonFragment(
            [
                'text' => $commentText,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\Comment::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testCommentId = 1;
        $commentText   = 'testcommenttext';

        $response = $this->put(route('comment:update', $testCommentId),
            [
                'text' => $commentText,
            ]);

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Comment::response()
        );

        $response->assertJsonFragment(
            [
                'text' => $commentText,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Blog\Domain\Permission\Comment::DELETE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testCommentId = 1;

        $response = $this->delete(route('comment:delete', ['commentId' => $testCommentId]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testSearch()
    {
        self::assertEquals(TRUE, TRUE);
    }
}

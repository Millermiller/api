<?php

namespace Tests\Feature\Controllers\Blog;

use Illuminate\Http\JsonResponse;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    private int $commentCount = 2;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $category = entity(Category::class, 1)->create();
        $post = entity(Post::class, 1)->create(['category' => $category, 'user' => entity(User::class, 1)->create()]);
        $this->user = entity(User::class, 1)->create();

        entity(Comment::class, $this->commentCount)->create(['post' => $post, 'user' => $this->user]);
    }

    public function testIndex()
    {
        $response = $this->get(route('comment:all'));

        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->commentCount, $decodedResponse);
        $response->assertJsonStructure(
            [
                \Tests\Responses\Comment::response()
            ]
        );
    }

    public function testShow()
    {
        $testCommetId = 1;
        $response = $this->get(route('comment:show', ['commentId' => $testCommetId]));

        $response->assertJsonStructure(
            \Tests\Responses\Comment::response()
        );

        $response->assertJsonFragment(
            [
                'id' => $testCommetId,
            ]
        );
    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $commentText = 'testcommenttext';

        $response = $this->post(route('comment:create'), [
            'post_id' => 1,
            'text' => $commentText
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

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $testCommetId = 1;
        $commentText = 'testcommenttext';

        $response = $this->put(route('comment:update', $testCommetId), [
            'text' => $commentText
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

    public function testDestroy()
    {
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
        self::assertEquals(true, true);
    }
}

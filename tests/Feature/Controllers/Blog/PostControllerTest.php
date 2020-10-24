<?php

namespace Tests\Feature\Controllers\Blog;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    private User $user;

    private Category $category;

    private int $postCount = 2;

    private Collection $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        $this->category = entity(Category::class, 1)->create();

        $this->post = entity(Post::class, $this->postCount)->create(
            [
                'category' => $this->category,
                'user' => $this->user,
            ]
        );
    }

    public function testIndex()
    {
        $response = $this->get(route('post:all'));
        $decodedResponse = json_decode($response->getContent());

        self::assertCount($this->postCount, $decodedResponse);

        $response->assertJsonStructure(
            [
                \Tests\Responses\Post::response(),
            ]
        );
    }

    public function testShow()
    {
        $testPostId = 1;
        $response = $this->get(route('post:show', ['postId' => $testPostId]));

        $response->assertJsonStructure(
            \Tests\Responses\Post::response()
        );

        $response->assertJsonFragment(
            [
                'id' => $testPostId,
            ]
        );
    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $testPostContent = 'TESTCONTENT';
        $testPostTitle = 'TESTTITLE';

        $response = $this->post(
            route('post:create'),
            [
                'category' => $this->category->getId(),
                'status' => 1,
                'title' => $testPostTitle,
                'content' => $testPostContent,
            ]
        );

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Post::response()
        );

        $response->assertJsonFragment(
            [
                'content' => $testPostContent,
                'title' => $testPostTitle,
            ]
        );
    }

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $testPostContent = 'TESTCONTENT';
        $testPostTitle = 'TESTTITLE';

        $response = $this->put(
            route('post:update', ['postId' => $this->post->first()->getId()]),
            [
                'title' => $testPostTitle,
                'content' => $testPostContent,
            ]
        );

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Post::response()
        );

        $response->assertJsonFragment(
            [
                'content' => $testPostContent,
                'title' => $testPostTitle,
            ]
        );
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('post:delete', ['postId' => $this->post->first()->getId()]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testUpload()
    {
        self::assertEquals(true, true);
    }
}

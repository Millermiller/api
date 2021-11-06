<?php


namespace Scandinaver\Blog\UI\Resources;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Blog\Domain\Entity\Post;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class PostTransformer
 *
 * @package Scandinaver\Blog\UI\Resource
 */
class PostTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'comments',
    ];

    protected $defaultIncludes = [
        'user',
        'category',
    ];

    public function transform(Post $post): array
    {
        return [
            'id'             => $post->getId(),
            'title'          => $post->getTitle(),
            'content'        => $post->getContent(),
            'views'          => $post->getViews(),
            'status'         => $post->getStatus(),
            'comment_status' => $post->getCommentStatus(),
            'created_at'     => $post->getCreatedAt()->format("Y-m-d H:i:s"),
        ];
    }

    public function includeUser(Post $post): Item
    {
        $user = $post->getUser();

        return $this->item($user, new UserTransformer());
    }

    public function includeComments(Post $post): Collection
    {
        $comments = $post->getComments();

        return $this->collection($comments, new CommentTransformer());
    }

    public function includeCategory(Post $post): Item
    {
        $category = $post->getCategory();

        return $this->item($category, new CategoryTransformer());
    }
}
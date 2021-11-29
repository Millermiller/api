<?php


namespace Scandinaver\Blog\UI\Resources;

use JetBrains\PhpStorm\ArrayShape;
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

    #[ArrayShape([
        'id'             => "int",
        'title'          => "null|string",
        'content'        => "null|string",
        'views'          => "int",
        'status'         => "int",
        'comment_status' => "int",
        'created_at'     => "string",
    ])]
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
        return $this->item($post->getUser(), new UserTransformer(), 'user');
    }

    public function includeComments(Post $post): Collection
    {
        $comments = $post->getComments();

        return $this->collection($comments, new CommentTransformer(), 'comments');
    }

    public function includeCategory(Post $post): Item
    {
        $category = $post->getCategory();

        return $this->item($category, new CategoryTransformer(), 'category');
    }
}
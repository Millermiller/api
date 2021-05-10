<?php


namespace Scandinaver\Blog\UI\Resources;

use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class CommentTransformer
 *
 * @package Scandinaver\Blog\UI\Resource
 */
class CommentTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'user',
    ];

    public function transform(Comment $comment): array
    {
        return [
            'id'   => $comment->getId(),
            'text' => $comment->getText(),
        ];
    }

    public function includeUser(Comment $comment): Item
    {
        $user = $comment->getUser();

        return $this->item($user, new UserTransformer());
    }
}
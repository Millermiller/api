<?php


namespace Scandinaver\Blog\Domain\Event;

use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Shared\DomainEvent;

/**
 * Class CommentAdded
 *
 * @package Scandinaver\Blog\Domain\Event
 */
class CommentAdded implements DomainEvent
{
    private Post $post;

    private Comment $comment;

    public function __construct(Post $post, Comment $comment)
    {
        $this->post    = $post;
        $this->comment = $comment;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }
}
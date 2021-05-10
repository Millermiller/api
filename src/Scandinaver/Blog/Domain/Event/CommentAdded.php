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
    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }
}
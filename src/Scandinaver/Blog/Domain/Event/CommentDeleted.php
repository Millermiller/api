<?php


namespace Scandinaver\Blog\Domain\Event;

use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Shared\DomainEvent;

/**
 * Class CommentDeleted
 *
 * @package Scandinaver\Blog\Domain\Event
 *
 */
class CommentDeleted implements DomainEvent
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
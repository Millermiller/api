<?php


namespace Scandinaver\Blog\Domain\Event;

use Scandinaver\Blog\Domain\Entity\Comment;
use Scandinaver\Core\Domain\Contract\DomainEvent;

/**
 * Class CommentUpdated
 *
 * @package Scandinaver\Blog\Domain\Event
 *
 */
class CommentUpdated implements DomainEvent
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
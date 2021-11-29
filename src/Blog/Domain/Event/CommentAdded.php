<?php


namespace Scandinaver\Blog\Domain\Event;

use Scandinaver\Blog\Domain\Entity\Comment;
use Scandinaver\Blog\Domain\Entity\Post;
use Scandinaver\Core\Domain\Contract\DomainEvent;

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
<?php


namespace Scandinaver\Blog\Domain\Event;

use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Shared\DomainEvent;

/**
 * Class PostDeleted
 *
 * @package Scandinaver\Blog\Domain\Event
 *
 */
class PostDeleted implements DomainEvent
{

    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
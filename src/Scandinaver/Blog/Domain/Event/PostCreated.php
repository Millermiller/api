<?php


namespace Scandinaver\Blog\Domain\Event;

use Scandinaver\Blog\Domain\Entity\Post;
use Scandinaver\Shared\DomainEvent;

/**
 * Class PostCreated
 *
 * @package Scandinaver\Blog\Domain\Event
 *
 */
class PostCreated implements DomainEvent
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
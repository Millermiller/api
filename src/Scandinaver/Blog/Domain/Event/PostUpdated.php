<?php


namespace Scandinaver\Blog\Domain\Event;

use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Shared\DomainEvent;

/**
 * Class PostUpdated
 *
 * @package Scandinaver\Blog\Domain\Event
 *
 */
class PostUpdated implements DomainEvent
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
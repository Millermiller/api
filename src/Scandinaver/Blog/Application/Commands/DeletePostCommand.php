<?php


namespace Scandinaver\Blog\Application\Commands;

use Scandinaver\Blog\Domain\Post;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class DeletePostCommand
 *
 * @package Scandinaver\Blog\Application\Commands
 * @see     \Scandinaver\Blog\Application\Handlers\DeletePostHandler
 */
class DeletePostCommand implements Command
{
    /**
     * @var Post
     */
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }
}
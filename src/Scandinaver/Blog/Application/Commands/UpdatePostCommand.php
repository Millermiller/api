<?php


namespace Scandinaver\Blog\Application\Commands;

use Scandinaver\Blog\Domain\Post;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class UpdatePostCommand
 *
 * @package Scandinaver\Blog\Application\Commands
 * @see     \Scandinaver\Blog\Application\Handlers\UpdatePostHandler
 */
class UpdatePostCommand implements Command
{
    /**
     * @var Post
     */
    private $post;

    /**
     * @var array
     */
    private $data;

    public function __construct(Post $post, array $data)
    {
        $this->post = $post;
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }
}
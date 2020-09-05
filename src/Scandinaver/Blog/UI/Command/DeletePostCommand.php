<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeletePostCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\DeletePostHandler
 * @package Scandinaver\Blog\UI\Command
 */
class DeletePostCommand implements Command
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
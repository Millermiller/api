<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePostCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdatePostHandler
 * @package Scandinaver\Blog\UI\Command
 */
class UpdatePostCommand implements Command
{
    private Post $post;

    private array $data;

    public function __construct(Post $post, array $data)
    {
        $this->post = $post;
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
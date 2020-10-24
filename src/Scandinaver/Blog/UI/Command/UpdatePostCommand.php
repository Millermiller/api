<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePostCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdatePostHandler
 * @package Scandinaver\Blog\UI\Command
 */
class UpdatePostCommand implements Command
{
    private int $postId;

    private array $data;

    public function __construct(int $postId, array $data)
    {
        $this->postId = $postId;
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }
}
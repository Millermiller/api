<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdatePostCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdatePostHandler
 */
class UpdatePostCommand implements CommandInterface
{
    private int $postId;

    private array $data;

    public function __construct(int $postId, array $data)
    {
        $this->postId = $postId;
        $this->data   = $data;
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
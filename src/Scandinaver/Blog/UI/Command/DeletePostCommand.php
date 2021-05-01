<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeletePostCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\DeletePostHandler
 */
class DeletePostCommand implements CommandInterface
{

    private int $postId;

    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }
}
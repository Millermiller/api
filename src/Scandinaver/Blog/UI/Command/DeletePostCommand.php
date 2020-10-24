<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeletePostCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\DeletePostHandler
 * @package Scandinaver\Blog\UI\Command
 */
class DeletePostCommand implements Command
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
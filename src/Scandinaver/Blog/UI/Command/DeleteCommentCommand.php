<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCommentCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\DeleteCommentHandler
 * @package Scandinaver\Blog\UI\Command
 */
class DeleteCommentCommand implements Command
{

    private int $commentId;

    public function __construct(int $commentId)
    {
        $this->commentId = $commentId;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

}
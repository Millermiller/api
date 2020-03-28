<?php


namespace Scandinaver\Blog\Application\Commands;

use Scandinaver\Blog\Domain\Comment;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class DeleteCommentCommand
 *
 * @package Scandinaver\Blog\Application\Commands
 * @see     \Scandinaver\Blog\Application\Handlers\DeleteCommentHandler
 */
class DeleteCommentCommand implements Command
{
    /**
     * @var Comment
     */
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }
}
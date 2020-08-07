<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCommentCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\DeleteCommentHandler
 * @package Scandinaver\Blog\UI\Command
 */
class DeleteCommentCommand implements Command
{
    /**
     * @var Comment
     */
    private Comment $comment;

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
<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCommentCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdateCommentHandler
 * @package Scandinaver\Blog\UI\Command
 */
class UpdateCommentCommand implements Command
{
    private Comment $comment;

    private array $data;

    public function __construct(Comment $comment, array $data)
    {
        $this->comment = $comment;
        $this->data = $data;
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
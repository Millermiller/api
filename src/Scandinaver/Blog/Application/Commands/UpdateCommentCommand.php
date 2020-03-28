<?php


namespace Scandinaver\Blog\Application\Commands;

use Scandinaver\Blog\Domain\Comment;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class UpdateCommentCommand
 * @package Scandinaver\Blog\Application\Commands
 *
 * @see \Scandinaver\Blog\Application\Handlers\UpdateCommentHandler
 */
class UpdateCommentCommand implements Command
{
    /**
     * @var Comment
     */
    private $comment;

    /**
     * @var array
     */
    private $data;

    public function __construct(Comment $comment, array $data)
    {
        $this->comment = $comment;
        $this->data = $data;
    }

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
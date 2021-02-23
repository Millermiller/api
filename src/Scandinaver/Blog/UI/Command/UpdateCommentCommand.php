<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCommentCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdateCommentHandler
 */
class UpdateCommentCommand implements Command
{
    private array $data;

    private int $commentId;

    public function __construct(int $commentId, array $data)
    {
        $this->commentId = $commentId;
        $this->data      = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }
}
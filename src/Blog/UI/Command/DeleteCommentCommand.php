<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\DeleteCommentCommandHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class DeleteCommentCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Handler(DeleteCommentCommandHandler::class)]
class DeleteCommentCommand implements CommandInterface
{

    public function __construct(private int $commentId)
    {
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\UpdateCommentCommandHandler;
use Scandinaver\Blog\Domain\DTO\CommentDTO;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateCommentCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Command(UpdateCommentCommandHandler::class)]
class UpdateCommentCommand implements CommandInterface
{

    private array $data;

    private int $commentId;

    private UserInterface $user;

    public function __construct(UserInterface $user, int $commentId, array $data)
    {
        $this->commentId = $commentId;
        $this->data      = $data;
        $this->user      = $user;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function buildDTO(): CommentDTO
    {
        $data           = $this->data;
        $data['userId'] = $this->user->getId();

        return CommentDTO::fromArray($data);
    }
}
<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\DTO\CommentDTO;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateCommentCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdateCommentHandler
 */
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
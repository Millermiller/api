<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\DTO\CommentDTO;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateCommentCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\CreateCommentCommandHandler
 */
class CreateCommentCommand implements CommandInterface
{

    private array $data;

    private UserInterface $user;

    public function __construct(UserInterface $user, array $data)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function buildDTO(): CommentDTO
    {
        $data           = $this->data;
        $data['userId'] = $this->user->getId();

        return CommentDTO::fromArray($data);
    }
}
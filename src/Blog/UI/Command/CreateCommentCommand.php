<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\CreateCommentCommandHandler;
use Scandinaver\Blog\Domain\DTO\CommentDTO;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateCommentCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Handler(CreateCommentCommandHandler::class)]
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
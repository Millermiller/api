<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\CreatePostCommandHandler;
use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreatePostCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Handler(CreatePostCommandHandler::class)]
class CreatePostCommand implements CommandInterface
{

    private array $data;

    private UserInterface $user;

    public function __construct(UserInterface $user, array $data)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function buildDTO(): PostDTO
    {
        $data           = $this->data;
        $data['userId'] = $this->user->getId();

        return PostDTO::fromArray($data);
    }
}
<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreatePostCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\CreatePostCommandHandler
 */
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
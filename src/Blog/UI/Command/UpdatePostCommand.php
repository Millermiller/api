<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\UpdatePostCommandHandler;
use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdatePostCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Handler(UpdatePostCommandHandler::class)]
class UpdatePostCommand implements CommandInterface
{

    private int $postId;

    private array $data;

    public function __construct(UserInterface $user, int $postId, array $data)
    {
        $this->postId         = $postId;
        $this->data           = $data;
        $this->data['userId'] = $user->getId();
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function buildDTO(): PostDTO
    {
        return PostDTO::fromArray($this->data);
    }
}
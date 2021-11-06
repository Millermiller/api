<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdatePostCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdatePostHandler
 */
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
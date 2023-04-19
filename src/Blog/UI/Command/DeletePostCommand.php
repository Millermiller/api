<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\DeletePostCommandHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class DeletePostCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Handler(DeletePostCommandHandler::class)]
class DeletePostCommand implements CommandInterface
{

    public function __construct(private int $postId)
    {
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
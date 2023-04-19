<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Application\Handler\Command\DeleteMessageCommandHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class DeleteMessageCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
#[Handler(DeleteMessageCommandHandler::class)]
class DeleteMessageCommand implements CommandInterface
{

    public function __construct(private int $messageId)
    {
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteMessageCommand
 *
 * @package Scandinaver\Common\UI\Command
 *
 * @see     \Scandinaver\Common\Application\Handler\Command\DeleteMessageCommandHandler
 */
class DeleteMessageCommand implements CommandInterface
{
    private int $messageId;

    public function __construct(int $messageId)
    {
        $this->messageId = $messageId;
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }
}
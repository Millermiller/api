<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Domain\Model\Message;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteMessageCommand
 * @see \Scandinaver\Common\Application\Handler\Command\DeleteMessageHandler
 * @package Scandinaver\Common\UI\Command
 */
class DeleteMessageCommand implements Command
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
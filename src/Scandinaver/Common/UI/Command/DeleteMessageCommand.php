<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Domain\Message;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteMessageCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
class DeleteMessageCommand implements Command
{
    /**
     * @var Message
     */
    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }
}
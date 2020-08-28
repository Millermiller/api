<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Domain\Model\Message;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteMessageCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
class DeleteMessageCommand implements Command
{
    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }
}
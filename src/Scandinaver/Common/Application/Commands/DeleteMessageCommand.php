<?php


namespace Scandinaver\Common\Application\Commands;

use Scandinaver\Common\Domain\Message;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class DeleteMessageCommand
 * @package Scandinaver\Common\Application\Commands
 */
class DeleteMessageCommand implements Command
{
    /**
     * @var Message
     */
    private $message;

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
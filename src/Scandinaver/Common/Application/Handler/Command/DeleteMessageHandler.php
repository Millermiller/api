<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\Domain\Contract\Command\DeleteMessageHandlerInterface;
use Scandinaver\Common\Domain\Exception\MessageNotFoundException;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Command\DeleteMessageCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteMessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteMessageHandler implements DeleteMessageHandlerInterface
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * @param  DeleteMessageCommand|Command  $command
     *
     * @throws MessageNotFoundException
     */
    public function handle($command): void
    {
        $this->messageService->delete($command->getMessageId());
    }
} 
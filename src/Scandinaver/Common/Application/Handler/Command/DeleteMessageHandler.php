<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Contract\Command\DeleteMessageHandlerInterface;
use Scandinaver\Common\Domain\Exception\MessageNotFoundException;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Command\DeleteMessageCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteMessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteMessageHandler extends AbstractHandler implements DeleteMessageHandlerInterface
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        parent::__construct();

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

        $this->resource = new NullResource();
    }
} 
<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;

use Scandinaver\Common\Domain\Exception\MessageNotFoundException;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Command\DeleteMessageCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteMessageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteMessageCommandHandler extends AbstractHandler
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        parent::__construct();

        $this->messageService = $messageService;
    }

    /**
     * @param  DeleteMessageCommand|CommandInterface  $command
     *
     * @throws MessageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->messageService->delete($command->getMessageId());

        $this->resource = new NullResource();
    }
} 
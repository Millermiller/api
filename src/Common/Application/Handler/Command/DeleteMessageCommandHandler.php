<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\UI\Command\DeleteMessageCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteMessageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteMessageCommandHandler extends AbstractHandler
{

    public function __construct(private MessageService $service)
    {
        parent::__construct();

    }

    public function handle(CommandInterface|DeleteMessageCommand $command): void
    {
        $this->service->delete($command->getMessageId());

        $this->resource = new NullResource();
    }
} 
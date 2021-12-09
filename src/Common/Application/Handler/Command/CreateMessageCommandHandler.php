<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\FeedbackService;
use Scandinaver\Common\UI\Command\CreateMessageCommand;
use Scandinaver\Common\UI\Resource\FeedbackTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateMessageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateMessageCommandHandler extends AbstractHandler
{

    public function __construct(private FeedbackService $service)
    {
        parent::__construct();
    }

    public function handle(CommandInterface|CreateMessageCommand $command): void
    {
        $feedback = $this->service->create($command->buildDTO());

        $this->resource = new Item($feedback, new FeedbackTransformer());
    }
} 
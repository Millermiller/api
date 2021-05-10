<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\FeedbackService;
use Scandinaver\Common\UI\Command\CreateMessageCommand;
use Scandinaver\Common\UI\Resource\FeedbackTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreateMessageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateMessageCommandHandler extends AbstractHandler
{

    private FeedbackService $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        parent::__construct();
        $this->feedbackService = $feedbackService;
    }

    /**
     * @param  CreateMessageCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $feedback = $this->feedbackService->create($command->buildDTO());

        $this->resource = new Item($feedback, new FeedbackTransformer());
    }
} 
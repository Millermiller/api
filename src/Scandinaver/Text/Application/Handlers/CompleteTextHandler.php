<?php


namespace Scandinaver\Text\Application\Handlers;

use Scandinaver\Text\Application\Commands\CompleteTextCommand;
use Scandinaver\Text\Domain\TextService;

/**
 * Class CompleteTextHandler
 * @package Scandinaver\Text\Application\Handlers
 */
class CompleteTextHandler implements CompleteTextHandlerInterface
{
    /**
     * @var TextService
     */
    private $textService;

    /**
     * TextController constructor.
     * @param TextService $textService
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param CompleteTextCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->textService->giveNextLevel($command->getUser(), $command->getText());
    }
} 
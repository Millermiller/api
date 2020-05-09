<?php


namespace Scandinaver\Translate\Application\Handlers;

use Scandinaver\Translate\Application\Commands\CompleteTextCommand;
use Scandinaver\Translate\Domain\TextService;

/**
 * Class CompleteTextHandler
 *
 * @package Scandinaver\Translate\Application\Handlers
 */
class CompleteTextHandler implements CompleteTextHandlerInterface
{
    /**
     * @var TextService
     */
    private $textService;

    /**
     * TextController constructor.
     *
     * @param TextService $textService
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param CompleteTextCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->textService->giveNextLevel($command->getUser(), $command->getText());
    }
} 
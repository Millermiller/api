<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Commands\EditTranslateCommand;
use Scandinaver\Learn\Domain\Services\CardService;

/**
 * Class EditTranslateHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class EditTranslateHandler implements EditTranslateHandlerInterface
{
    /**
     * @var CardService
     */
    private $cardService;

    /**
     * GetTranslatesByWordHandler constructor.
     *
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param EditTranslateCommand $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->cardService->editTranslate($command->getTranslate(), $command->getText());

        $this->cardService->deleteExamplesOfCard($command->getCard());
    }
} 
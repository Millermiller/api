<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Commands\SetTranslateForCardCommand;
use Scandinaver\Learn\Domain\Services\CardService;

/**
 * Class SetTranslateForCardHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class SetTranslateForCardHandler implements SetTranslateForCardHandlerInterface
{
    /**
     * @var CardService
     */
    private $cardService;

    /**
     * GetTranslatesByWordHandler constructor.
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param SetTranslateForCardCommand $command
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->cardService->updateCard($command->getCard(), $command->getWord(), $command->getTranslate(), $command->getAsset());
    }
} 
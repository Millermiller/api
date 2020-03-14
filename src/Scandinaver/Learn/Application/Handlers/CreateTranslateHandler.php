<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Commands\CreateTranslateCommand;
use Scandinaver\Learn\Domain\Services\CardService;

/**
 * Class CreateTranslateHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class CreateTranslateHandler implements CreateTranslateHandlerInterface
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
     * @param CreateTranslateCommand $command
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->cardService->addExample($command->getCard(), $command->getText(), $command->getValue());
    }
} 
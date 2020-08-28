<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\CreateTranslateHandlerInterface;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\CreateTranslateCommand;

/**
 * Class CreateTranslateHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateTranslateHandler implements CreateTranslateHandlerInterface
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param  CreateTranslateCommand  $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->cardService->addExample($command->getCard(), $command->getText(), $command->getValue());
    }
} 
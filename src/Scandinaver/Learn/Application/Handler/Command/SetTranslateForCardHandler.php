<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\SetTranslateForCardHandlerInterface;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\SetTranslateForCardCommand;

/**
 * Class SetTranslateForCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class SetTranslateForCardHandler implements SetTranslateForCardHandlerInterface
{
    /**
     * @var CardService
     */
    private $cardService;

    /**
     * GetTranslatesByWordHandler constructor.
     *
     * @param  CardService  $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param  SetTranslateForCardCommand  $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->cardService->updateCard($command->getCard(), $command->getWord(), $command->getTranslate(),
            $command->getAsset());
    }
} 
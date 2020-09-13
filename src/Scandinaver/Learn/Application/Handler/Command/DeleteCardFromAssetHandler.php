<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\DeleteCardFromAssetHandlerInterface;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\DeleteCardFromAssetCommand;

/**
 * Class DeleteCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class DeleteCardFromAssetHandler implements DeleteCardFromAssetHandlerInterface
{
    protected CardService $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param  DeleteCardFromAssetCommand  $command
     */
    public function handle($command): void
    {
        $this->cardService->removeCardFromAsset($command->getCard(), $command->getAsset());

        // event(new CardDeleted($command->getUser(), $command->getCard()));
    }
}
<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\AddCardToAssetHandlerInterface;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\AddCardToAssetCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class AddCardToAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class AddCardToAssetHandler implements AddCardToAssetHandlerInterface
{
    protected CardService $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param  AddCardToAssetCommand|Command  $command
     */
    public function handle($command): void
    {
        $card = $this->cardService->addCardToAsset(
            $command->getUser(),
            $command->getLanguage(),
            $command->getCard(),
            $command->getAsset()
        );
    }
}
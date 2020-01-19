<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\CardAdded;
use Scandinaver\Learn\Application\Commands\AddCardToAssetCommand;
use Scandinaver\Learn\Domain\Services\CardService;

/**
 * Class AddCardToAssetHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class AddCardToAssetHandler implements AddCardToAssetHandlerInterface
{
    /**
     * @var CardService
     */
    protected $cardService;

    /**
     * CardsController constructor.
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param AddCardToAssetCommand $command
     */
    public function handle($command): void
    {
        $card = $this->cardService->createCard($command->getWord(), $command->getTranslate(), $command->getAsset());

        event(new CardAdded($command->getUser(), $card));
    }
}
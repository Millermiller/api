<?php


namespace Scandinaver\Learn\Application\Handlers;

use App\Events\CardDeleted;
use Scandinaver\Learn\Application\Commands\DeleteCardFromAssetCommand;
use Scandinaver\Learn\Domain\Services\CardService;

/**
 * Class DeleteCardHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class DeleteCardFromAssetHandler implements DeleteCardFromAssetHandlerInterface
{
    /**
     * @var CardService
     */
    protected $cardService;

    /**
     * CardsController constructor.
     *
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param DeleteCardFromAssetCommand $command
     */
    public function handle($command): void
    {
        $this->cardService->destroyCard($command->getCard());

        event(new CardDeleted($command->getUser(), $command->getCard()));
    }
}
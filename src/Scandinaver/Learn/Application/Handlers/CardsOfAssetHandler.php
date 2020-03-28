<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\CardsOfAssetQuery;
use Scandinaver\Learn\Domain\Services\CardService;

/**
 * Class CardsOfAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class CardsOfAssetHandler implements CardsOfAssetHandlerInterface
{
    /**
     * @var CardService
     */
    protected $cardService;

    /**
     * CardsOfAssetHandler constructor.
     *
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param CardsOfAssetQuery $query
     *
     * @return array
     */
    public function handle($query)
    {
        return $this->cardService->getCards($query->getLanguage(), $query->getUser(), $query->getAsset());
    }
}
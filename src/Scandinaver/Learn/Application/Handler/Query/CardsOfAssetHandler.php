<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\CardsOfAssetHandlerInterface;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Query\CardsOfAssetQuery;

/**
 * Class CardsOfAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class CardsOfAssetHandler implements CardsOfAssetHandlerInterface
{
    protected CardService $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param  CardsOfAssetQuery  $query
     *
     * @return array
     */
    public function handle($query)
    {
        return $this->cardService->getCards($query->getLanguage(), $query->getUser(), $query->getAsset());
    }
}
<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Contract\Query\CardsOfAssetHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Query\CardsOfAssetQuery;
use Scandinaver\Learn\UI\Resources\AssetDTOTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class CardsOfAssetHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class CardsOfAssetHandler extends AbstractHandler implements CardsOfAssetHandlerInterface
{
    protected CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  CardsOfAssetQuery|Query  $query
     *
     * @throws AssetNotFoundException
     */
    public function handle($query): void
    {
        $data = $this->cardService->getCards($query->getUser(), $query->getAsset());

        $this->resource = new Item($data, new AssetDTOTransformer());

        $this->fractal->parseIncludes('cards');
    }
}
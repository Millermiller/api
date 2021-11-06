<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Query\CardsOfAssetQuery;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CardsOfAssetQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class CardsOfAssetQueryHandler extends AbstractHandler
{
    protected CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  CardsOfAssetQuery|BaseCommandInterface  $query
     *
     * @throws AssetNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $data = $this->cardService->getCards($query->getUser(), $query->getAsset());

        $this->resource = new Item($data, new AssetTransformer());

        $this->fractal->parseIncludes('cards');
    }
}
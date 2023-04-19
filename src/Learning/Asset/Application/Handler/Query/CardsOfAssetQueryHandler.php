<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Query\CardsOfAssetQuery;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class CardsOfAssetQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class CardsOfAssetQueryHandler extends AbstractHandler
{

    public function __construct(protected CardService $cardService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|CardsOfAssetQuery  $query
     *
     * @throws AssetNotFoundException
     */
    public function handle(BaseCommandInterface|CardsOfAssetQuery $query): void
    {
        $data = $this->cardService->getCards($query->getUser(), $query->getAsset());

        $this->resource = new Item($data, new AssetTransformer(), 'asset');

        $this->fractal->parseIncludes('cards');
    }
}
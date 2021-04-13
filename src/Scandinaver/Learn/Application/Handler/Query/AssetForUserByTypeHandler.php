<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Exception;
use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Contract\Query\AssetForUserByTypeHandlerInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\AssetForUserByTypeQuery;
use Scandinaver\Learn\UI\Resources\AssetDTOTransformer;
use Scandinaver\Learn\UI\Resources\AssetTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class AssetForUserByTypeHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetForUserByTypeHandler extends AbstractHandler implements AssetForUserByTypeHandlerInterface
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  AssetForUserByTypeQuery|Query  $query
     *
     * @throws Exception
     */
    public function handle($query): void
    {
        $assets = $this->assetService->getAssetsByType($query->getLanguage(), $query->getUser(), $query->getType());

        $this->resource = new Collection($assets, new AssetDTOTransformer());
    }
}
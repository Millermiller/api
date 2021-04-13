<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Contract\Query\GetAssetsByTypeHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\GetAssetsByTypeQuery;
use Scandinaver\Learn\UI\Resources\AssetTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetAssetsByTypeHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAssetsByTypeHandler extends AbstractHandler implements GetAssetsByTypeHandlerInterface
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  GetAssetsByTypeQuery|Query  $query
     *
     * @throws LanguageNotFoundException
     * @throws BindingResolutionException
     */
    public function handle($query): void
    {
        $assets = $this->assetService->getAssets($query->getLanguage(), $query->getType());

        $this->resource = new Collection($assets, new AssetTransformer());
    }
} 
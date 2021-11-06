<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Query\GetAssetsByTypeQuery;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class GetAssetsByTypeQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAssetsByTypeQueryHandler extends AbstractHandler
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  GetAssetsByTypeQuery|BaseCommandInterface  $query
     *
     * @throws LanguageNotFoundException
     * @throws BindingResolutionException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $assets = $this->assetService->getAssets($query->getLanguage(), $query->getType());

        $this->resource = new Collection($assets, new AssetTransformer());
    }
} 
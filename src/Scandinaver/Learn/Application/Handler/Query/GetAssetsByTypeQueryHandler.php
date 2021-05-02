<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Service\AssetService;
use Scandinaver\Learn\UI\Query\GetAssetsByTypeQuery;
use Scandinaver\Learn\UI\Resource\AssetTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

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
     * @param  GetAssetsByTypeQuery|CommandInterface  $query
     *
     * @throws LanguageNotFoundException
     * @throws BindingResolutionException
     */
    public function handle(CommandInterface $query): void
    {
        $assets = $this->assetService->getAssets($query->getLanguage(), $query->getType());

        $this->resource = new Collection($assets, new AssetTransformer());
    }
} 
<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Query\GetAssetsByTypeQuery;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetAssetsByTypeQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAssetsByTypeQueryHandler extends AbstractHandler
{

    public function __construct(private AssetService $assetService)
    {
        parent::__construct();
    }

    /**
     * @param  GetAssetsByTypeQuery  $query
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
<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use Illuminate\Contracts\Container\BindingResolutionException;
use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Query\AssetForUserByTypeQuery;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class AssetForUserByTypeQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetForUserByTypeQueryHandler extends AbstractHandler
{

    public function __construct(protected AssetService $assetService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|AssetForUserByTypeQuery  $query
     *
     * @throws BindingResolutionException
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface|AssetForUserByTypeQuery $query): void
    {
        $assets = $this->assetService->getAssetsByType($query->getLanguage(), $query->getUser(), $query->getType());

        $this->resource = new Collection($assets, new AssetTransformer());
    }
}
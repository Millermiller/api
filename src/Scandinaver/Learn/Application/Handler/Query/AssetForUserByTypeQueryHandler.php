<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Exception;
use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Service\AssetService;
use Scandinaver\Learn\UI\Query\AssetForUserByTypeQuery;
use Scandinaver\Learn\UI\Resource\AssetDTOTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AssetForUserByTypeQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetForUserByTypeQueryHandler extends AbstractHandler
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  AssetForUserByTypeQuery|CommandInterface  $query
     *
     * @throws Exception
     */
    public function handle(CommandInterface $query): void
    {
        $assets = $this->assetService->getAssetsByType($query->getLanguage(), $query->getUser(), $query->getType());

        $this->resource = new Collection($assets, new AssetDTOTransformer());
    }
}
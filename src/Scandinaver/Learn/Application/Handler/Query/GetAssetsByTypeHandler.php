<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\GetAssetsByTypeHandlerInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\GetAssetsByTypeQuery;

/**
 * Class GetAssetsByTypeHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAssetsByTypeHandler implements GetAssetsByTypeHandlerInterface
{
    /**
     * @var AssetService
     */
    private AssetService $assetService;

    /**
     * GetAssetsByTypeHandler constructor.
     *
     * @param  AssetService  $assetService
     */
    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param $query GetAssetsByTypeQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        return $this->assetService->getAssets($query->getLanguage(), $query->getType());
    }
} 
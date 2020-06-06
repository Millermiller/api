<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\GetAssetsByTypeQuery;
use Scandinaver\Learn\Domain\Services\AssetService;

/**
 * Class GetAssetsByTypeHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class GetAssetsByTypeHandler implements GetAssetsByTypeHandlerInterface
{
    /**
     * @var AssetService
     */
    private $assetService;

    /**
     * GetAssetsByTypeHandler constructor.
     *
     * @param AssetService $assetService
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
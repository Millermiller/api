<?php


namespace Scandinaver\Learn\Application\Handlers;

use Exception;
use Scandinaver\Learn\Application\Query\AssetForUserByTypeQuery;
use Scandinaver\Learn\Domain\Services\AssetService;

/**
 * Class AssetForUserByTypeHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class AssetForUserByTypeHandler implements AssetForUserByTypeHandlerInterface
{
    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * AssetForUserByTypeHandler constructor.
     * @param AssetService $assetService
     */
    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param AssetForUserByTypeQuery $query
     * @return array
     * @throws Exception
     */
    public function handle($query)
    {
        return $this->assetService->getAssetsByType($query->getUser(), $query->getType());
    }
}
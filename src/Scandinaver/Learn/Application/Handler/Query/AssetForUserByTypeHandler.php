<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Exception;
use Scandinaver\Learn\Domain\Contract\Query\AssetForUserByTypeHandlerInterface;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\AssetForUserByTypeQuery;

/**
 * Class AssetForUserByTypeHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetForUserByTypeHandler implements AssetForUserByTypeHandlerInterface
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  AssetForUserByTypeQuery  $query
     *
     * @return array
     * @throws Exception
     */
    public function handle($query)
    {
        return $this->assetService->getAssetsByType($query->getLanguage(), $query->getUser(), $query->getType());
    }
}
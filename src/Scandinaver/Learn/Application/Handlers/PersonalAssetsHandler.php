<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\PersonalAssetsQuery;
use Scandinaver\Learn\Domain\Services\AssetService;

/**
 * Class PersonalAssetsHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class PersonalAssetsHandler implements PersonalAssetsHandlerInterface
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
     * @param PersonalAssetsQuery $query
     * @return array
     */
    public function handle($query): array
    {
        return $this->assetService->getPersonalAssets($query->getUser());
    }
}
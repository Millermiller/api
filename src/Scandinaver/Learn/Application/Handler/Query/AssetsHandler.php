<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Exception;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\Domain\Contract\Query\AssetsHandlerInterface;
use Scandinaver\Learn\UI\Query\AssetsQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class AssetsHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsHandler implements AssetsHandlerInterface
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  AssetsQuery|Query  $query
     *
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->assetService->getAssetsForApp($query->getLanguage(), $query->getUser());
    }
}
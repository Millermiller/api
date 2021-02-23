<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\GetAssetsByTypeHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\GetAssetsByTypeQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetAssetsByTypeHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAssetsByTypeHandler implements GetAssetsByTypeHandlerInterface
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  GetAssetsByTypeQuery|Query  $query
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function handle($query)
    {
        return $this->assetService->getAssets($query->getLanguage(), $query->getType());
    }
} 
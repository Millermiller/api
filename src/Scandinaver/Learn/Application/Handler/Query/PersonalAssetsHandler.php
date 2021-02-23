<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\PersonalAssetsHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\PersonalAssetsQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PersonalAssetsHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class PersonalAssetsHandler implements PersonalAssetsHandlerInterface
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @param  PersonalAssetsQuery|Query  $query
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function handle($query): array
    {
        return $this->assetService->getPersonalAssets($query->getLanguage(), $query->getUser());
    }
}
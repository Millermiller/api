<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Contract\Query\PersonalAssetsHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\PersonalAssetsQuery;
use Scandinaver\Learn\UI\Resources\AssetDTOTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PersonalAssetsHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class PersonalAssetsHandler extends AbstractHandler implements PersonalAssetsHandlerInterface
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  PersonalAssetsQuery|Query  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle($query): void
    {
        $assetDTOs = $this->assetService->getPersonalAssets($query->getLanguage(), $query->getUser());

        $this->resource = new Collection($assetDTOs, new AssetDTOTransformer());
    }
}
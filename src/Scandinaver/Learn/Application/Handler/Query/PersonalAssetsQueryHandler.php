<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\PersonalAssetsQuery;
use Scandinaver\Learn\UI\Resources\AssetDTOTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PersonalAssetsQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class PersonalAssetsQueryHandler extends AbstractHandler
{
    protected AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  PersonalAssetsQuery|CommandInterface  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $assetDTOs = $this->assetService->getPersonalAssets($query->getLanguage(), $query->getUser());

        $this->resource = new Collection($assetDTOs, new AssetDTOTransformer());
    }
}
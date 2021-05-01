<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Exception;
use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\AssetsQuery;
use Scandinaver\Learn\UI\Resources\AssetDTOTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AssetsQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsQueryHandler extends AbstractHandler
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  AssetsQuery|CommandInterface  $query
     *
     * @throws Exception
     */
    public function handle(CommandInterface $query): void
    {
        $assetDTOs = $this->assetService->getAssetsForApp($query->getLanguage(), $query->getUser());

        $this->resource = new Collection($assetDTOs, new AssetDTOTransformer());
    }
}
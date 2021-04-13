<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Primitive;
use Scandinaver\Learn\Domain\Contract\Query\AssetsCountHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\AssetService;
use Scandinaver\Learn\UI\Query\AssetsCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class AssetsCountHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsCountHandler extends AbstractHandler implements AssetsCountHandlerInterface
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  AssetsCountQuery|Query  $query
     *
     * @return int
     * @throws LanguageNotFoundException
     */
    public function handle($query): void
    {
        $count = $this->assetService->count($query->getLanguage());

        $this->resource = new Primitive($count);
    }
}
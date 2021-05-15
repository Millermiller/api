<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Service\AssetService;
use Scandinaver\Learn\UI\Query\AssetsCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AssetsCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsCountQueryHandler extends AbstractHandler
{
    private AssetService $assetService;

    public function __construct(AssetService $assetService)
    {
        parent::__construct();

        $this->assetService = $assetService;
    }

    /**
     * @param  AssetsCountQuery|BaseCommandInterface  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $count = $this->assetService->count($query->getLanguage());

        $this->resource = new Item($count, fn($data) => ['count' => $data]);
    }
}
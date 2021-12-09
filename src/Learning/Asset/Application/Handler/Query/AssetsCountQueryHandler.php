<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Query\AssetsCountQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class AssetsCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsCountQueryHandler extends AbstractHandler
{

    public function __construct(private AssetService $assetService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|AssetsCountQuery  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface|AssetsCountQuery $query): void
    {
        $count = $this->assetService->count($query->getLanguage());

        $this->resource = new Item($count, fn($data) => ['count' => $data]);
    }
}
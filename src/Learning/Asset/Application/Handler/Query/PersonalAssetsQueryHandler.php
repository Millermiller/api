<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Asset\UI\Query\PersonalAssetsQuery;
use Scandinaver\Learning\Asset\UI\Resource\AssetTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class PersonalAssetsQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class PersonalAssetsQueryHandler extends AbstractHandler
{

    public function __construct(protected AssetService $assetService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|PersonalAssetsQuery  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface|PersonalAssetsQuery $query): void
    {
        $assetDTOs = $this->assetService->getPersonalAssets($query->getLanguage(), $query->getUser());

        $this->resource = new Collection($assetDTOs, new AssetTransformer());
    }
}
<?php


namespace Scandinaver\Learning\Asset\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\Repository\CountableRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\HasLevelRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;

/**
 * Interface AssetRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Asset>
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface AssetRepositoryInterface extends BaseRepositoryInterface, CountableRepositoryInterface, HasLevelRepositoryInterface, FilterableRepositoryInterface
{
    /**
     * @param  Language  $language
     *
     * @return Asset[]
     */
    public function getByLanguage(Language $language): array;

    /**
     * @param  Language  $language
     *
     * @return Asset[]
     */
    public function getPublicAssets(Language $language): array;
}
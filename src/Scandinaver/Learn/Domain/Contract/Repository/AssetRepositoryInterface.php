<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Contract\Repository\CountableRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\HasLevelRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface AssetRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Asset>
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface AssetRepositoryInterface extends BaseRepositoryInterface, CountableRepositoryInterface, HasLevelRepositoryInterface
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
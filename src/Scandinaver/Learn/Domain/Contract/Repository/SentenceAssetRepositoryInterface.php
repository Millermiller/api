<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Entity\Asset;

/**
 * Interface SentenceAssetRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface SentenceAssetRepositoryInterface
{
    public function getFirstAsset(Language $language, int $type): Asset;

    public function getNextAsset(Asset $asset): Asset;

    public function getLastAsset(Language $language, int $type): ?Asset;
}
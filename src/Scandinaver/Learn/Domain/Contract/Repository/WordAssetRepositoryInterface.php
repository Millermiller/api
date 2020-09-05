<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface WordAssetRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface WordAssetRepositoryInterface extends BaseRepositoryInterface
{
    public function getFirstAsset(Language $language, int $type): Asset;

    public function getLastAsset(Language $language, int $type): Asset;

    public function getNextAsset(Asset $asset, Language $language): Asset;
}
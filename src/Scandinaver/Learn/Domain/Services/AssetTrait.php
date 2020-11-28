<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\AssetNotFoundException;
use Scandinaver\Learn\Domain\Model\Asset;

/**
 * Trait AssetTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait AssetTrait
{
    private function getAsset(int $id): Asset
    {
        /** @var  AssetRepositoryInterface $repository */
        $repository = Container::getInstance()->get(AssetRepositoryInterface::class);

        /** @var Asset $asset */
        $asset = $repository->find($id);

        if ($asset === null) {
            throw new AssetNotFoundException();
        }

        return $asset;
    }
}
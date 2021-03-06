<?php


namespace Scandinaver\Learn\Domain\Service;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learn\Domain\Entity\Asset;

/**
 * Trait AssetTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait AssetTrait
{
    /**
     * @param  int  $id
     *
     * @return Asset
     * @throws AssetNotFoundException
     */
    private function getAsset(int $id): Asset
    {
        $repository = Container::getInstance()->get(AssetRepositoryInterface::class);

        $asset = $repository->find($id);

        if ($asset === NULL) {
            throw new AssetNotFoundException();
        }

        return $asset;
    }
}
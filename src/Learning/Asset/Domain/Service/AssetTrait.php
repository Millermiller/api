<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Scandinaver\Core\Infrastructure\Service\Container;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Exception\AssetNotFoundException;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;

/**
 * Trait AssetTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait AssetTrait
{

    /**
     * @param  string  $id
     *
     * @return Asset
     * @throws AssetNotFoundException
     */
    private function getAsset(string $id): Asset
    {
        $repository = Container::getInstance()->get(AssetRepositoryInterface::class);

        $asset = $repository->find($id);

        if ($asset === NULL) {
            throw new AssetNotFoundException();
        }

        return $asset;
    }
}
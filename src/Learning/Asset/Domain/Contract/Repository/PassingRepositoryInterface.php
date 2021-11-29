<?php


namespace Scandinaver\Learning\Asset\Domain\Contract\Repository;

use Scandinaver\Learning\Asset\Domain\Entity\{Asset, Passing};
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;

/**
 * Interface PassingRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Passing>
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface PassingRepositoryInterface extends BaseRepositoryInterface
{
    public function getPassing(UserInterface $user, Asset $asset): ?Passing;
}
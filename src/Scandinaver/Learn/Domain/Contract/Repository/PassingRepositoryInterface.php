<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Learn\Domain\Model\{Asset, Passing};
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface PassingRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface PassingRepositoryInterface extends BaseRepositoryInterface
{
    public function getPassing(UserInterface $user, Asset $asset): ?Passing;
}
<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Learn\Domain\Model\{Asset, Passing};
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Interface PassingRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface PassingRepositoryInterface extends BaseRepositoryInterface
{
    public function getPassing(User $user, Asset $asset): ?Passing;
}
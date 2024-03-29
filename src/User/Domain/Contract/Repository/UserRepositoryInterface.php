<?php


namespace Scandinaver\User\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;

/**
 * Interface UserRepositoryInterface
 *
 * @extends BaseRepositoryInterface<UserInterface>
 * @package Scandinaver\User\Domain\Contract
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{

    public function findByNameOrEmail(string $string): array;
}
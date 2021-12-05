<?php


namespace Scandinaver\RBAC\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;

/**
 * Interface RoleRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Role>
 * @package Scandinaver\User\Domain\Contract\Repository
 */
interface RoleRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}
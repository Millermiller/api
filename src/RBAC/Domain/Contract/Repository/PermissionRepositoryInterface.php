<?php


namespace Scandinaver\RBAC\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;

/**
 * Interface PermissionRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Permission>
 * @package Scandinaver\User\Domain\Contract\Repository
 */
interface PermissionRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}
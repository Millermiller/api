<?php


namespace Scandinaver\Blog\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;

/**
 * Interface PostRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Post>
 * @package Scandinaver\Blog\Domain\Contract\Repository
 */
interface PostRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}
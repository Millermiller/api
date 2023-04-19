<?php


namespace Scandinaver\Blog\Domain\Contract\Repository;

use Scandinaver\Blog\Domain\Entity\Category;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;

/**
 * Interface CategoryRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Category>
 * @package Scandinaver\Blog\Domain\Contract\Repository
 */
interface CategoryRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}
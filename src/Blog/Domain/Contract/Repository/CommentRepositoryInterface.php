<?php


namespace Scandinaver\Blog\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;

/**
 * Interface CommentRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Comment>
 * @package Scandinaver\Blog\Domain\Contract\Repository
 */
interface CommentRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}
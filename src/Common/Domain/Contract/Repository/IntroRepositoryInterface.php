<?php


namespace Scandinaver\Common\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Entity\Intro;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;

/**
 * Interface IntroRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Intro>
 * @package Scandinaver\Common\Domain\Contract\Repository
 */
interface IntroRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}
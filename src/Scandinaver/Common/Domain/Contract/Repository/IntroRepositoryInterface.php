<?php


namespace Scandinaver\Common\Domain\Contract\Repository;

use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface IntroRepositoryInterface
 *
 * @package Scandinaver\Common\Domain\Contract\Repository
 */
interface IntroRepositoryInterface extends BaseRepositoryInterface
{

    public function getGrouppedIntro();

}
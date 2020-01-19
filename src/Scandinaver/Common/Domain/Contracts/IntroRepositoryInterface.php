<?php


namespace Scandinaver\Common\Domain\Contracts;

use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Interface IntroRepositoryInterface
 * @package Scandinaver\Common\Domain\Contracts
 */
interface IntroRepositoryInterface extends BaseRepositoryInterface
{
    public function getGrouppedIntro();
}
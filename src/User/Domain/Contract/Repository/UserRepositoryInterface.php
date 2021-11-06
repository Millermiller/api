<?php


namespace Scandinaver\User\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface UserRepositoryInterface
 *
 * @extends BaseRepositoryInterface<UserInterface>
 * @package Scandinaver\User\Domain\Contract
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * @param $string
     *
     * @return array
     */
    public function findByNameOrEmail($string): array;
}
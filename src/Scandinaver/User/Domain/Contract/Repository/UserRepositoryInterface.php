<?php


namespace Scandinaver\User\Domain\Contract\Repository;

use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface UserRepositoryInterface
 *
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
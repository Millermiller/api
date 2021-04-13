<?php


namespace Scandinaver\User\Domain\Contract\Repository;

use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\User\Domain\Model\{Plan, User};

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
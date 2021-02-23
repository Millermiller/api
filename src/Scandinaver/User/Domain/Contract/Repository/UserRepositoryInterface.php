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
    public function addText(User $user, Text $text): void;

    public function setPlan(User $user, Plan $plan): void;

    /**
     * @param  User    $user
     * @param  string  $file
     *
     * @return mixed
     */
    public function setAvatar(User $user, string $file);

    /**
     * @param $string
     *
     * @return array
     */
    public function findByNameOrEmail($string): array;
}
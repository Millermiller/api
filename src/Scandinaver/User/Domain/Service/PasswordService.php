<?php


namespace Scandinaver\User\Domain\Service;

use Illuminate\Contracts\Hashing\Hasher;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PasswordService
 *
 * @package Scandinaver\User\Domain\Services
 */
class PasswordService
{
    private Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param  User  $user
     * @param        $password
     */
    public function changePassword(User $user, $password)
    {
        $user->setPassword($this->hasher->make($password));
    }
}
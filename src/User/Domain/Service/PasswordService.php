<?php


namespace Scandinaver\User\Domain\Service;

use Illuminate\Contracts\Hashing\Hasher;
use Scandinaver\User\Domain\Entity\User;

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

    public function changePassword(User $user, string $password)
    {
        $user->setPassword($this->hasher->make($password));
    }
}
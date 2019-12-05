<?php


namespace App\Services;

use App\Entities\User;
use Exception;
use \Illuminate\Contracts\Hashing\Hasher;

class PasswordService
{
    private $hasher;
    private $passwordStrengthValidator;

    /**
     * @param Hasher $hasher
     */
    public function __construct( Hasher $hasher) {
        $this->hasher = $hasher;
    }

    /**
     * Validate and change the given users password
     *
     * @param User $user
     * @param string $password
     * @return void
     * @throws Exception
     */
    public function changePassword(User $user, $password)
    {
        $user->setPassword($this->hasher->make($password));
    }
}
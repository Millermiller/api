<?php


namespace Scandinaver\User\Domain\Services;

use Scandinaver\User\Domain\User;
use Exception;
use Illuminate\Contracts\Hashing\Hasher;

/**
 * Class PasswordService
 * @package App\Services
 */
class PasswordService
{
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @param Hasher $hasher
     */
    public function __construct(Hasher $hasher)
    {
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
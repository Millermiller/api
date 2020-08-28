<?php


namespace Scandinaver\Common\Domain\Services;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;

/**
 * Class FileService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class FileService
{
    private UserRepositoryInterface $userRepository;

    /**
     * FileService constructor.
     *
     * @param  UserRepositoryInterface  $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function uploadAvatar(Request $request)
    {
        $name = Str::random(40).'.'.$request->file('photo')->extension();

        $path = $request->file('photo')->move(
            public_path('/uploads/u/'),
            $name
        );

        $this->userRepository->setAvatar(Auth::user(), $name);

        return $path;
    }
}
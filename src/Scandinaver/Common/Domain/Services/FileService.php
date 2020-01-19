<?php


namespace Scandinaver\Common\Domain\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Scandinaver\User\Domain\Contracts\UserRepositoryInterface;

/**
 * Class FileService
 * @package Scandinaver\Common\Services
 */
class FileService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * FileService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function uploadAvatar(Request $request)
    {
        $name = Str::random(40).'.'.$request->file('photo')->extension();

        $path = $request->file('photo')->move(public_path('/uploads/u/'),  $name);

        $this->userRepository->setAvatar(\Auth::user(), $name);

        return $path;
    }
}
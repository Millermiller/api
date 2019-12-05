<?php


namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use \Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileService
{
    private $userRepository;

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
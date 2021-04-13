<?php


namespace Scandinaver\Common\Domain\Services;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Model\User;
use Storage;
use Symfony\Component\HttpFoundation\File\File;

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

    /**
     * @param  User          $user
     * @param  UploadedFile  $photo
     *
     * @return string
     */
    public function uploadAvatar(User $user, UploadedFile $photo): string
    {
        $filename = Str::random(40).'.'.$photo->extension();

        $photo->move(public_path('/uploads/u/'), $filename);

        $user->setPhoto($filename);

        $this->userRepository->save($user);

        return public_path('/uploads/u/') . $filename;
    }
}
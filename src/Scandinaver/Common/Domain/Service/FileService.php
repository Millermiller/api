<?php


namespace Scandinaver\Common\Domain\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;

/**
 * Class FileService
 *
 * @package Scandinaver\Common\Domain\Service
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
     * @param  UserInterface  $user
     * @param  UploadedFile   $photo
     *
     * @return string
     */
    public function uploadAvatar(UserInterface $user, UploadedFile $photo): string
    {
        $filename = Str::random(40) . '.' . $photo->extension();

        $photo->move(public_path('/uploads/u/'), $filename);

        $user->setPhoto($filename);

        $this->userRepository->save($user);

        return public_path('/uploads/u/') . $filename;
    }
}
<?php


namespace Scandinaver\Common\Domain\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class FileService
 *
 * @package Scandinaver\Common\Domain\Service
 */
class FileService
{
    private UserRepositoryInterface $userRepository;

    private LoggerInterface $logger;

    public function __construct(
        UserRepositoryInterface $userRepository,
        LoggerInterface $logger
    )
    {
        $this->userRepository = $userRepository;
        $this->logger = $logger;
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

        return asset('/uploads/u/') . $filename;
    }

    public function uploadFlag(Language $language, UploadedFile $photo): string
    {
        $filename = $language->getLetter() . '.' . $photo->extension();

        try {
            $photo->move(public_path('/img/'), $filename);

            return "/img/$filename";
        } catch (FileException $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
<?php


namespace Scandinaver\User\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UploadAvatarCommand
 *
 * @package Scandinaver\User\UI\Command
 *
 * @see     \Scandinaver\User\Application\Handler\Command\UploadAvatarCommandHandler
 */
class UploadAvatarCommand implements CommandInterface
{
    private UploadedFile $photo;

    private UserInterface $user;

    public function __construct(UserInterface $user, UploadedFile $photo)
    {
        $this->photo = $photo;
        $this->user  = $user;
    }

    public function getPhoto(): UploadedFile
    {
        return $this->photo;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
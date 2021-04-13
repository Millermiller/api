<?php


namespace Scandinaver\User\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class UploadAvatarCommand
 *
 * @package Scandinaver\User\UI\Command
 *
 * @see     \Scandinaver\User\Application\Handler\Command\UploadAvatarHandler
 */
class UploadAvatarCommand implements Command
{
    private UploadedFile $photo;

    private User $user;

    public function __construct(User $user, UploadedFile $photo)
    {
        $this->photo = $photo;
        $this->user  = $user;
    }

    public function getPhoto(): UploadedFile
    {
        return $this->photo;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
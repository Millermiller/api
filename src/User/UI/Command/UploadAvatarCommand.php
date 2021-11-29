<?php


namespace Scandinaver\User\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\User\Application\Handler\Command\UploadAvatarCommandHandler;

/**
 * Class UploadAvatarCommand
 *
 * @package Scandinaver\User\UI\Command
 */
#[Command(UploadAvatarCommandHandler::class)]
class UploadAvatarCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private UploadedFile $photo)
    {
    }

    public function getPhoto(): UploadedFile
    {
        return $this->photo;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
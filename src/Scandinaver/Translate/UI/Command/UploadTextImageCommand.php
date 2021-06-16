<?php


namespace Scandinaver\Translate\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class UploadTextImageCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see \Scandinaver\Translate\Application\Handler\Command\UploadTextImageCommandHandler
 */
class UploadTextImageCommand implements CommandInterface
{

    private int $id;

    private UploadedFile $photo;

    public function __construct(int $id, UploadedFile $photo)
    {
        $this->id = $id;

        $this->photo = $photo;
    }

    public function buildDTO(): DTO
    {
         // TODO: Implement buildDTO() method.
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getPhoto(): UploadedFile
    {
        return $this->photo;
    }
}
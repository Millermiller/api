<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Translate\Application\Handler\Command\UploadTextImageCommandHandler;

/**
 * Class UploadTextImageCommand
 *
 * @package Scandinaver\Learning\Translate\UI\Command
 */
#[Handler(UploadTextImageCommandHandler::class)]
class UploadTextImageCommand implements CommandInterface
{

    public function __construct(private int $id, private UploadedFile $photo)
    {
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
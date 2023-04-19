<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\UploadAudioCommandHandler;

/**
 * Class UploadAudioCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(UploadAudioCommandHandler::class)]
class UploadAudioCommand implements CommandInterface
{

    public function __construct(private int $termId, private UploadedFile $file)
    {
    }

    public function getTermId(): int
    {
        return $this->termId;
    }

    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
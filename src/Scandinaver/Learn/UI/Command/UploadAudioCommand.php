<?php


namespace Scandinaver\Learn\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class UploadAudioCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UploadAudioCommandHandler
 */
class UploadAudioCommand implements CommandInterface
{
    private int $termId;

    private UploadedFile $file;

    public function __construct(int $termId, UploadedFile $file)
    {
        $this->termId = $termId;
        $this->file = $file;
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
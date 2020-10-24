<?php


namespace Scandinaver\Learn\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UploadAudioCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UploadAudioHandler
 * @package Scandinaver\Learn\UI\Command
 */
class UploadAudioCommand implements Command
{
    private int $word;

    private UploadedFile $file;

    public function __construct(int $word, UploadedFile $file)
    {
        $this->word = $word;
        $this->file = $file;
    }

    public function getWord(): int
    {
        return $this->word;
    }

    public function getFile(): UploadedFile
    {
        return $this->file;
    }
}
<?php


namespace Scandinaver\Learn\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UploadAudioCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UploadAudioHandler
 * @package Scandinaver\Learn\UI\Command
 */
class UploadAudioCommand implements Command
{
    private Word $word;

    private UploadedFile $file;

    public function __construct(Word $word, UploadedFile $file)
    {
        $this->word = $word;
        $this->file = $file;
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function getFile(): UploadedFile
    {
        return $this->file;
    }
}
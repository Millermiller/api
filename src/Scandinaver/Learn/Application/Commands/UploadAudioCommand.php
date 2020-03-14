<?php


namespace Scandinaver\Learn\Application\Commands;

use Illuminate\Http\UploadedFile;
use Request;
use Scandinaver\Learn\Domain\Word;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class UploadAudioCommand
 * @package Scandinaver\Learn\Application\Commands
 */
class UploadAudioCommand implements Command
{
    /**
     * @var Word
     */
    private $word;

    /**
     * @var UploadedFile UploadedFile
     */
    private $file;

    /**
     * UploadAudioCommand constructor.
     * @param Word $word
     * @param UploadedFile $file
     */
    public function __construct(Word $word, UploadedFile $file)
    {
        $this->word = $word;
        $this->file = $file;
    }

    /**
     * @return Word
     */
    public function getWord(): Word
    {
        return $this->word;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }
}
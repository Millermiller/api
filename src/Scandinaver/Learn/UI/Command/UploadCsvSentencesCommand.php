<?php


namespace Scandinaver\Learn\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UploadCsvSentencesCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UploadCsvSentencesCommandHandler
 */
class UploadCsvSentencesCommand implements CommandInterface
{
    private string $language;

    private UploadedFile $file;

    public function __construct(string $language, UploadedFile $file)
    {
        $this->language = $language;
        $this->file     = $file;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getFile(): UploadedFile
    {
        return $this->file;
    }
}
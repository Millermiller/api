<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Illuminate\Http\UploadedFile;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\UploadCsvSentencesCommandHandler;

/**
 * Class UploadCsvSentencesCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(UploadCsvSentencesCommandHandler::class)]
class UploadCsvSentencesCommand implements CommandInterface
{

    public function __construct(private string $language, private UploadedFile $file)
    {
    }

    public function getLanguage(): string
    {
        return $this->language;
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
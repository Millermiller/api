<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Learn\Domain\Contract\Command\UploadCsvSentencesHandlerInterface;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UploadCsvSentencesHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UploadCsvSentencesHandler implements UploadCsvSentencesHandlerInterface
{

    private CardService $service;

    public function __construct(CardService $service)
    {
        $this->service = $service;
    }

    /**
     * @param UploadCsvSentencesCommand|Command $command
     */
    public function handle($command)
    {
        $this->service->uploadCsvSentences($command->getLanguage(), $command->getFile());
    }
} 
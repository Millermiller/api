<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\UploadCsvSentencesHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UploadCsvSentencesHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UploadCsvSentencesHandler extends AbstractHandler implements UploadCsvSentencesHandlerInterface
{

    private CardService $service;

    public function __construct(CardService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UploadCsvSentencesCommand|Command  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle($command): void
    {
        $this->service->uploadCsvSentences($command->getLanguage(), $command->getFile());

        $this->resource = new NullResource();
    }
} 
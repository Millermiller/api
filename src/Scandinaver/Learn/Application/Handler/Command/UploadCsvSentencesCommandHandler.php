<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UploadCsvSentencesCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UploadCsvSentencesCommandHandler extends AbstractHandler
{

    private CardService $service;

    public function __construct(CardService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UploadCsvSentencesCommand|CommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->uploadCsvSentences($command->getLanguage(), $command->getFile());

        $this->resource = new NullResource();
    }
} 
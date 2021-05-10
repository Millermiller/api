<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Service\CardService;
use Scandinaver\Learn\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  UploadCsvSentencesCommand|BaseCommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->uploadCsvSentences($command->getLanguage(), $command->getFile());

        $this->resource = new NullResource();
    }
} 
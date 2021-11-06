<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class UploadCsvSentencesCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
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
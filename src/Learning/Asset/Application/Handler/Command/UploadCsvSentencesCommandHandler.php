<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UploadCsvSentencesCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class UploadCsvSentencesCommandHandler extends AbstractHandler
{

    public function __construct(private CardService $service)
    {
        parent::__construct();
    }

    /**
     * @param  UploadCsvSentencesCommand  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->uploadCsvSentences($command->getLanguage(), $command->getFile());

        $this->resource = new NullResource();
    }
} 
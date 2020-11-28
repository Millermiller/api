<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Learn\Domain\Contract\Command\UploadCsvSentencesHandlerInterface;

/**
 * Class UploadCsvSentencesHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UploadCsvSentencesHandler implements UploadCsvSentencesHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param UploadCsvSentencesCommand $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
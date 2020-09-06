<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Translate\UI\Command\CreateSynonymCommand;
use Scandinaver\Translate\Domain\Contract\Command\CreateSynonymHandlerInterface;

/**
 * Class CreateSynonymHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateSynonymHandler implements CreateSynonymHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param $command CreateSynonymCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
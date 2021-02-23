<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\CreateSynonymHandlerInterface;
use Scandinaver\Translate\UI\Command\CreateSynonymCommand;

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
     * @param  CreateSynonymCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
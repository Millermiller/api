<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\UI\Command\CreateSynonymCommand;

/**
 * Class CreateSynonymCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateSynonymCommandHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  CreateSynonymCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
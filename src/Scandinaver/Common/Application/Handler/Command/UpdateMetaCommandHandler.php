<?php


namespace Scandinaver\Common\Application\Handler\Command;

use Scandinaver\Common\UI\Command\UpdateMetaCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateMetaCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateMetaCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UpdateMetaCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
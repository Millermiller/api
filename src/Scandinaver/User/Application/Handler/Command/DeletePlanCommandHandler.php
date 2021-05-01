<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\UI\Command\DeletePlanCommand;

/**
 * Class DeletePlanCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class DeletePlanCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  DeletePlanCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
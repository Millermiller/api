<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\UI\Command\CreatePlanCommand;

/**
 * Class CreatePlanCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class CreatePlanCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  CreatePlanCommand|CommandInterface  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\UI\Command\UpdatePlanCommand;

/**
 * Class UpdatePlanCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdatePlanCommandHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UpdatePlanCommand|CommandInterface  $command
     *
     * @inheritDoc
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
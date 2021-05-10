<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
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
     * @param  DeletePlanCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
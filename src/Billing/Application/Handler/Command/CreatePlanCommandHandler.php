<?php


namespace Scandinaver\Billing\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Billing\UI\Command\CreatePlanCommand;

/**
 * Class CreatePlanCommandHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Command
 */
class CreatePlanCommandHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  CreatePlanCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
<?php


namespace Scandinaver\Billing\Application\Handler\Command;

use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Scandinaver\Billing\UI\Command\DeletePlanCommand;

/**
 * Class DeletePlanCommandHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Command
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
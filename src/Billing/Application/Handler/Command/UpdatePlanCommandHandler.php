<?php


namespace Scandinaver\Billing\Application\Handler\Command;

use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Scandinaver\Billing\UI\Command\UpdatePlanCommand;

/**
 * Class UpdatePlanCommandHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Command
 */
class UpdatePlanCommandHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UpdatePlanCommand|BaseCommandInterface  $command
     *
     * @inheritDoc
     */
    public function handle(BaseCommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
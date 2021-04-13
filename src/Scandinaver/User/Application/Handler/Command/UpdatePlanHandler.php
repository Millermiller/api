<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\UpdatePlanHandlerInterface;
use Scandinaver\User\UI\Command\UpdatePlanCommand;

/**
 * Class UpdatePlanHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class UpdatePlanHandler extends AbstractHandler implements UpdatePlanHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UpdatePlanCommand|Command  $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
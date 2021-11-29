<?php


namespace Scandinaver\Billing\Application\Handler\Command;

use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Billing\UI\Command\UpdateOrderCommand;

/**
 * Class UpdateOrderCommandHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Command
 */
class UpdateOrderCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param UpdateOrderCommand|CommandInterface $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
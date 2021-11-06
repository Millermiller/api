<?php


namespace Scandinaver\Billing\Application\Handler\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Billing\UI\Command\DeleteOrderCommand;

/**
 * Class DeleteOrderCommandHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Command
 */
class DeleteOrderCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param DeleteOrderCommand|CommandInterface $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
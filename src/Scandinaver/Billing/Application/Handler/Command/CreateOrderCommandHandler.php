<?php


namespace Scandinaver\Billing\Application\Handler\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Billing\UI\Command\CreateOrderCommand;

/**
 * Class CreateOrderCommandHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Command
 */
class CreateOrderCommandHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param CreateOrderCommand|CommandInterface $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
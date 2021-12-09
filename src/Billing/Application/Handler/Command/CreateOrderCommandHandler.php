<?php


namespace Scandinaver\Billing\Application\Handler\Command;

use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\AbstractHandler;
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

    public function handle(CreateOrderCommand|CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
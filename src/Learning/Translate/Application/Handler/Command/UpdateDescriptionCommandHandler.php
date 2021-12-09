<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use Scandinaver\Learning\Translate\UI\Command\UpdateDescriptionCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateDescriptionCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UpdateDescriptionCommandHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(CommandInterface|UpdateDescriptionCommand $command): void
    {
        // TODO: Implement handle() method.
    }
} 
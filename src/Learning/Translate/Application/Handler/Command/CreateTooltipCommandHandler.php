<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use Scandinaver\Learning\Translate\UI\Command\CreateTooltipCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateTooltipCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateTooltipCommandHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  CreateTooltipCommand  $command
     */
    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\UI\Command\CreateTooltipCommand;

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
     * @param  CreateTooltipCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\UpdateDescriptionHandlerInterface;
use Scandinaver\Translate\UI\Command\UpdateDescriptionCommand;

/**
 * Class UpdateDescriptionHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UpdateDescriptionHandler extends AbstractHandler implements UpdateDescriptionHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UpdateDescriptionCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
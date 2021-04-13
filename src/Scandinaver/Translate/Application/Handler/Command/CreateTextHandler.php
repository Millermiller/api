<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\CreateTextHandlerInterface;
use Scandinaver\Translate\UI\Command\CreateTextCommand;

/**
 * Class CreateTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateTextHandler extends AbstractHandler implements CreateTextHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  CreateTextCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
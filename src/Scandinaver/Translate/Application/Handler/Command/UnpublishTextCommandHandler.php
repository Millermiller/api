<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\UI\Command\UnpublishTextCommand;

/**
 * Class UnpublishTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UnpublishTextCommandHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UnpublishTextCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
} 
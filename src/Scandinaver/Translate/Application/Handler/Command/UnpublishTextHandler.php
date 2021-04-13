<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\UnpublishTextHandlerInterface;
use Scandinaver\Translate\UI\Command\UnpublishTextCommand;

/**
 * Class UnpublishTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UnpublishTextHandler extends AbstractHandler implements UnpublishTextHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  UnpublishTextCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
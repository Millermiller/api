<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Translate\UI\Command\UnpublishTextCommand;
use Scandinaver\Translate\Domain\Contract\Command\UnpublishTextHandlerInterface;

/**
 * Class UnpublishTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UnpublishTextHandler implements UnpublishTextHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  UnpublishTextCommand  $command
     *
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
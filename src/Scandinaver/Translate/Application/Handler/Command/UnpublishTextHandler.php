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
     * @param $command UnpublishTextCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
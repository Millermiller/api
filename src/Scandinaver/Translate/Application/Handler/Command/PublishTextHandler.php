<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Translate\UI\Command\PublishTextCommand;
use Scandinaver\Translate\Domain\Contract\Command\PublishTextHandlerInterface;

/**
 * Class PublishTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class PublishTextHandler implements PublishTextHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  PublishTextCommand  $command
     *
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
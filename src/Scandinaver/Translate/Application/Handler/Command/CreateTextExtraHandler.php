<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Translate\UI\Command\CreateTextExtraCommand;
use Scandinaver\Translate\Domain\Contract\Command\CreateTextExtraHandlerInterface;

/**
 * Class CreateTextExtraHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateTextExtraHandler implements CreateTextExtraHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  CreateTextExtraCommand  $command
     *
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
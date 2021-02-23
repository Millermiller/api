<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\CreateTextExtraHandlerInterface;
use Scandinaver\Translate\UI\Command\CreateTextExtraCommand;

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
     * @param  CreateTextExtraCommand|Command  $command
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
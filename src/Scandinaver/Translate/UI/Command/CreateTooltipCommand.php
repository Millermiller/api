<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreateTooltipCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\CreateTooltipCommandHandler
 */
class CreateTooltipCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
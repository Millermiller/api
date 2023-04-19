<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Translate\Application\Handler\Command\CreateTooltipCommandHandler;

/**
 * Class CreateTooltipCommand
 *
 * @package Scandinaver\Learning\Translate\UI\Command
 */
#[Handler(CreateTooltipCommandHandler::class)]
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
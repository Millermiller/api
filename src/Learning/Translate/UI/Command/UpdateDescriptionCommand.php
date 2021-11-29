<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Translate\Application\Handler\Command\UpdateDescriptionCommandHandler;

/**
 * Class UpdateDescriptionCommand
 *
 * @package Scandinaver\Learning\Translate\UI\Command
 */
#[Command(UpdateDescriptionCommandHandler::class)]
class UpdateDescriptionCommand implements CommandInterface
{

    private int $text;

    public function __construct(int $text)
    {
        $this->text = $text;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
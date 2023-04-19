<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Learning\Translate\Application\Handler\Command\CreateTextCommandHandler;
use Scandinaver\Learning\Translate\Domain\DTO\TextDTO;

/**
 * Class CreateTextCommand
 *
 * @package Scandinaver\Learning\Translate\UI\Command
 */
#[Handler(CreateTextCommandHandler::class)]
class CreateTextCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function buildDTO(): TextDTO
    {
        return TextDTO::fromArray($this->data);
    }
}
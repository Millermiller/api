<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Learning\Translate\Application\Handler\Command\UpdateTextCommandHandler;
use Scandinaver\Learning\Translate\Domain\DTO\TextDTO;

/**
 * Class UpdateTextCommand
 *
 * @package Scandinaver\Learning\Translate\UI\Command
 */
#[Handler(UpdateTextCommandHandler::class)]
class UpdateTextCommand implements CommandInterface
{

    public function __construct(private int $id, private array $data)
    {
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function buildDTO(): TextDTO
    {
        return TextDTO::fromArray($this->data);
    }
}
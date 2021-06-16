<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Translate\Domain\DTO\TextDTO;

/**
 * Class UpdateTextCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\UpdateTextCommandHandler
 */
class UpdateTextCommand implements CommandInterface
{

    private int $id;

    private array $data;

    public function __construct(int $id, array $data)
    {
        $this->id   = $id;
        $this->data = $data;
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
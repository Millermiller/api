<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdatePassingCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UpdatePassingHandler
 */
class UpdatePassingCommand implements Command
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

    public function getData(): array
    {
        return $this->data;
    }
}
<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 *
 * @see \Scandinaver\Settings\Application\Handler\Command\UpdateSettingCommandHandler
 */
class UpdateSettingCommand implements CommandInterface
{
    private int $id;

    private array $data;

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
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
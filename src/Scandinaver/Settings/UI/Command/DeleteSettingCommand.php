<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 *
 * @see \Scandinaver\Settings\Application\Handler\Command\DeleteSettingCommandHandler
 */
class DeleteSettingCommand implements CommandInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 *
 * @see \Scandinaver\Settings\Application\Handler\Command\CreateSettingCommandHandler
 */
class CreateSettingCommand implements CommandInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
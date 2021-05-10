<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
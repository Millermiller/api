<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Settings\Application\Handler\Command\CreateSettingCommandHandler;
use Scandinaver\Settings\Domain\DTO\SettingDTO;

/**
 * Class CreateSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 */
#[Handler(CreateSettingCommandHandler::class)]
class CreateSettingCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function buildDTO(): SettingDTO
    {
        return SettingDTO::fromArray($this->data);
    }
}
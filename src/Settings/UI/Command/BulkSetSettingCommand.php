<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Settings\Application\Handler\Command\BulkSetSettingCommandHandler;

/**
 * Class BulkSetSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 *
 * @see     \Scandinaver\Settings\Application\Handler\Command\BulkSetSettingCommandHandler
 */
#[Command(BulkSetSettingCommandHandler::class)]
class BulkSetSettingCommand implements CommandInterface
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
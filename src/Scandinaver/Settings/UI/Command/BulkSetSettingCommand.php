<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class BulkSetSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 *
 * @see \Scandinaver\Settings\Application\Handler\Command\BulkSetSettingCommandHandler
 */
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
}
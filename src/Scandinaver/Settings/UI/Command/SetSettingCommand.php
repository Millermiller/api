<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class SetSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 *
 * @see \Scandinaver\Settings\Application\Handler\Command\SetSettingCommandHandler
 */
class SetSettingCommand implements CommandInterface
{
    private int $id;

    private $value;

    /**
     * SetSettingCommand constructor.
     *
     * @param  int  $id
     * @param  mixed  $value
     */
    public function __construct(int $id, $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
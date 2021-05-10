<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreateTextExtraCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\CreateTextExtraCommandHandler
 */
class CreateTextExtraCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
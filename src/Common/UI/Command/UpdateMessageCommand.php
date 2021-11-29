<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class UpdateMessageCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
class UpdateMessageCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
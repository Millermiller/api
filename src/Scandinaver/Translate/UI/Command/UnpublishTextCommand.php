<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class UnpublishTextCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\UnpublishTextCommandHandler
 */
class UnpublishTextCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
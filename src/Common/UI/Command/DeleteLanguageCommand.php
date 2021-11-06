<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class DeleteLanguageCommand
 *
 * @package Scandinaver\Common\UI\Command
 *
 * @see \Scandinaver\Common\Application\Handler\Command\DeleteLanguageCommandHandler
 */
class DeleteLanguageCommand implements CommandInterface
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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
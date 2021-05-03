<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateLanguageCommand
 *
 * @package Scandinaver\Common\UI\Command
 *
 * @see \Scandinaver\Common\Application\Handler\Command\UpdateLanguageCommandHandler
 */
class UpdateLanguageCommand implements CommandInterface
{
    private int $id;

    private array $data;

    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
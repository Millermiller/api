<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateLanguageCommand
 *
 * @package Scandinaver\Common\UI\Command
 *
 * @see \Scandinaver\Common\Application\Handler\Command\CreateLanguageCommandHandler
 */
class CreateLanguageCommand implements CommandInterface
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
<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateIntroCommand
 *
 * @see     \Scandinaver\Common\Application\Handler\Command\CreateIntroHandler
 *
 * @package Scandinaver\Common\UI\Command
 */
class CreateIntroCommand implements Command
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
<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreatePlanCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\CreatePlanHandler
 * @package Scandinaver\User\UI\Command
 */
class CreatePlanCommand implements Command
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
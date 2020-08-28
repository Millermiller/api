<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateMetaCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
class CreateMetaCommand implements Command
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
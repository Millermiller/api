<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class CreateMetaCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
class CreateMetaCommand implements CommandInterface
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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
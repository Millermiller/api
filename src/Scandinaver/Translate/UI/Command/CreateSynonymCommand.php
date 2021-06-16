<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;
use Scandinaver\Translate\Domain\DTO\SynonymDTO;

/**
 * Class CreateSynonymCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\CreateSynonymCommandHandler
 */
class CreateSynonymCommand implements CommandInterface
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function buildDTO(): SynonymDTO
    {
        return SynonymDTO::fromArray($this->data);
    }
}
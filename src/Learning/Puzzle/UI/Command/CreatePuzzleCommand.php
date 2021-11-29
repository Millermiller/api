<?php


namespace Scandinaver\Learning\Puzzle\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Learning\Puzzle\Application\Handler\Command\CreatePuzzleCommandHandler;
use Scandinaver\Learning\Puzzle\Domain\DTO\PuzzleDTO;

/**
 * Class CreatePuzzleCommand
 *
 * @package Scandinaver\Puzzle\UI\Command
 */
#[Command(CreatePuzzleCommandHandler::class)]
class CreatePuzzleCommand implements CommandInterface
{

    private array $data;

    public function __construct(string $language, array $data)
    {
        $this->data                   = $data;
        $this->data['languageLetter'] = $language;
    }

    public function buildDTO(): PuzzleDTO
    {
        return PuzzleDTO::fromArray($this->data);
    }
}
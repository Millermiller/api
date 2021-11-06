<?php


namespace Scandinaver\Learning\Puzzle\UI\Command;

use Scandinaver\Learning\Puzzle\Domain\DTO\PuzzleDTO;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreatePuzzleCommand
 *
 * @package Scandinaver\Puzzle\UI\Command
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Command\CreatePuzzleCommandHandler
 */
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
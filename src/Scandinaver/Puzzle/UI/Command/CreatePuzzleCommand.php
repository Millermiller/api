<?php


namespace Scandinaver\Puzzle\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreatePuzzleCommand
 *
 * @package Scandinaver\Puzzle\UI\Command
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Command\CreatePuzzleHandler
 */
class CreatePuzzleCommand implements Command
{

    private string $language;

    private array $data;

    public function __construct(string $language, array $data)
    {
        $this->language = $language;
        $this->data     = $data;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
<?php


namespace Scandinaver\Puzzle\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PuzzleCompleteCommand
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Command\PuzzleCompleteHandler
 * @package Scandinaver\Puzzle\Application\Command
 */
class PuzzleCompleteCommand implements CommandInterface
{
    private UserInterface $user;

    private int $puzzle;

    public function __construct(UserInterface $user, int $puzzle)
    {
        $this->user   = $user;
        $this->puzzle = $puzzle;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getPuzzle(): int
    {
        return $this->puzzle;
    }
}
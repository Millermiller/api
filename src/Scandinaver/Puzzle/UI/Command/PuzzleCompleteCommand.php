<?php


namespace Scandinaver\Puzzle\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PuzzleCompleteCommand
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Command\PuzzleCompleteHandler
 * @package Scandinaver\Puzzle\Application\Command
 */
class PuzzleCompleteCommand implements Command
{
    private User $user;

    private int $puzzle;

    public function __construct(User $user, int $puzzle)
    {
        $this->user = $user;
        $this->puzzle = $puzzle;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPuzzle(): int
    {
        return $this->puzzle;
    }
}
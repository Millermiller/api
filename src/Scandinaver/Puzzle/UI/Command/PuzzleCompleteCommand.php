<?php


namespace Scandinaver\Puzzle\UI\Command;

use Scandinaver\Puzzle\Domain\Model\Puzzle;
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

    private Puzzle $puzzle;

    /**
     * PuzzleCompleteCommand constructor.
     *
     * @param  User    $user
     * @param  Puzzle  $puzzle
     */
    public function __construct(User $user, Puzzle $puzzle)
    {
        $this->user = $user;
        $this->puzzle = $puzzle;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPuzzle(): Puzzle
    {
        return $this->puzzle;
    }
}
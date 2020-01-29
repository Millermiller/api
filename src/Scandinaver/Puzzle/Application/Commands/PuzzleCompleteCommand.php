<?php


namespace Scandinaver\Puzzle\Application\Commands;

use Scandinaver\User\Domain\User;
use Scandinaver\Puzzle\Domain\Puzzle;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class PuzzleCompleteCommand
 * @package Scandinaver\Puzzle\Application\Commands
 */
class PuzzleCompleteCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Puzzle
     */
    private $puzzle;

    /**
     * PuzzleCompleteCommand constructor.
     * @param User $user
     * @param Puzzle $puzzle
     */
    public function __construct(User $user, Puzzle $puzzle)
    {
        $this->user = $user;
        $this->puzzle = $puzzle;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Puzzle
     */
    public function getPuzzle(): Puzzle
    {
        return $this->puzzle;
    }
}
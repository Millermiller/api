<?php


namespace Scandinaver\Puzzle\Application\Commands;

use Scandinaver\Puzzle\Domain\Puzzle;
use Scandinaver\Shared\Contracts\Command;
use Scandinaver\User\Domain\User;

/**
 * Class PuzzleCompleteCommand
 *
 * @package Scandinaver\Puzzle\Application\Commands
 * @see     \Scandinaver\Puzzle\Application\Handlers\PuzzleCompleteHandler
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
     *
     * @param User   $user
     * @param Puzzle $puzzle
     */
    public function __construct(User $user, Puzzle $puzzle)
    {
        $this->user   = $user;
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
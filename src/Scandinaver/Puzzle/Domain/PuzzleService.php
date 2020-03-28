<?php


namespace Scandinaver\Puzzle\Domain;

use Scandinaver\Puzzle\Domain\Contracts\PuzzleRepositoryInterface;
use Scandinaver\User\Domain\User;

/**
 * Class PuzzleService
 *
 * @package Scandinaver\Puzzle\Domain
 */
class PuzzleService
{
    /**
     * @var PuzzleRepositoryInterface
     */
    private $puzzleRepository;

    /**
     * PuzzleService constructor.
     *
     * @param PuzzleRepositoryInterface $puzzleRepository
     */
    public function __construct(PuzzleRepositoryInterface $puzzleRepository)
    {
        $this->puzzleRepository = $puzzleRepository;
    }

    /**
     * @param User   $user
     * @param Puzzle $puzzle
     */
    public function completed(User $user, Puzzle $puzzle): void
    {
        $this->puzzleRepository->addForUser($user, $puzzle);
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function getForUser(User $user): array
    {
        return $this->puzzleRepository->getForUser($user);
    }
}
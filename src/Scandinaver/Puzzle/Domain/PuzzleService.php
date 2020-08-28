<?php


namespace Scandinaver\Puzzle\Domain;

use Scandinaver\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PuzzleService
 *
 * @package Scandinaver\Puzzle\Domain
 */
class PuzzleService
{
    private PuzzleRepositoryInterface $puzzleRepository;

    public function __construct(PuzzleRepositoryInterface $puzzleRepository)
    {
        $this->puzzleRepository = $puzzleRepository;
    }

    public function completed(User $user, Puzzle $puzzle): void
    {
        $this->puzzleRepository->addForUser($user, $puzzle);
    }

    public function getForUser(User $user): array
    {
        return $this->puzzleRepository->getForUser($user);
    }
}
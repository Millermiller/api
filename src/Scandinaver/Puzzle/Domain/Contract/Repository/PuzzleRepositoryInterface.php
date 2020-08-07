<?php


namespace Scandinaver\Puzzle\Domain\Contract\Repository;

use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Interface PuzzleRepositoryInterface
 *
 * @package Scandinaver\Puzzle\Domain\Contract
 */
interface PuzzleRepositoryInterface extends BaseRepositoryInterface
{
    public function getForUser(User $user): array;

    public function addForUser(User $user, Puzzle $puzzle): void;
}
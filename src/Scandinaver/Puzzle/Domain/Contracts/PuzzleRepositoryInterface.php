<?php


namespace Scandinaver\Puzzle\Domain\Contracts;

use Scandinaver\Puzzle\Domain\Puzzle;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;
use Scandinaver\User\Domain\User;

/**
 * Interface PuzzleRepositoryInterface
 *
 * @package Scandinaver\Puzzle\Domain\Contracts
 */
interface PuzzleRepositoryInterface extends BaseRepositoryInterface
{
    public function getForUser(User $user): array;

    public function addForUser(User $user, Puzzle $puzzle): void;
}
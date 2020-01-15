<?php


namespace Scandinaver\Puzzle\Domain\Contracts;

use Scandinaver\Puzzle\Domain\Puzzle;
use Scandinaver\User\Domain\User;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Interface PuzzleRepositoryInterface
 * @package Scandinaver\Puzzle\Domain\Contracts
 */
interface PuzzleRepositoryInterface extends BaseRepositoryInterface
{
    public function getForUser(User $user): array;

    public function addForUser(User $user, Puzzle $puzzle): void;
}
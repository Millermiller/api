<?php

namespace Scandinaver\Puzzle\Domain;

use App\Entities\User;
use App\Repositories\BaseRepositoryInterface;

interface PuzzleRepositoryInterface extends BaseRepositoryInterface
{
    public function getForUser(User $user): array;

    public function addForUser(User $user, Puzzle $puzzle): void;
}
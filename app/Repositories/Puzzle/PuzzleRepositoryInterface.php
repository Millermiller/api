<?php

namespace App\Repositories\Puzzle;

use App\Entities\User;
use App\Repositories\BaseRepositoryInterface;

interface PuzzleRepositoryInterface extends BaseRepositoryInterface
{
    public function getForUser(User $user) : array;
}
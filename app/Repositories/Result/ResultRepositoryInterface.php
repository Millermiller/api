<?php

namespace App\Repositories\Result;

use App\Entities\{Asset, Language, Result, User};
use App\Repositories\BaseRepositoryInterface;

interface ResultRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveIds(User $user, Language $language): array;

    public function getResult(User $user, Asset $asset): Result;
}
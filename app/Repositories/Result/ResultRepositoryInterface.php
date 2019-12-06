<?php

namespace App\Repositories\Result;

use App\Entities\Language;
use App\Entities\User;
use App\Repositories\BaseRepositoryInterface;

interface ResultRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveIds(User $user, Language $language) : array;
}
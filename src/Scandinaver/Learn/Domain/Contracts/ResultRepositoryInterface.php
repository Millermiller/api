<?php

namespace Scandinaver\Learn\Domain\Contracts;

use App\Entities\{Language, User};
use App\Repositories\BaseRepositoryInterface;
use Scandinaver\Learn\Domain\{Asset, Result};

interface ResultRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveIds(User $user, Language $language): array;

    public function getResult(User $user, Asset $asset): Result;
}
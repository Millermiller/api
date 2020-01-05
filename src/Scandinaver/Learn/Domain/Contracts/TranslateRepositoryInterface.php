<?php

namespace Scandinaver\Learn\Domain\Contracts;

use App\Repositories\BaseRepositoryInterface;

interface TranslateRepositoryInterface extends BaseRepositoryInterface
{

    public function searchByIds(array $ids);
}
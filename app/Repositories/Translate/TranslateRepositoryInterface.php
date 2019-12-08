<?php

namespace App\Repositories\Translate;

use App\Repositories\BaseRepositoryInterface;

interface TranslateRepositoryInterface extends BaseRepositoryInterface
{

    public function searchByIds(array $ids);
}
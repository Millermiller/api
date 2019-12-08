<?php

namespace App\Repositories\Language;

use App\Entities\Language;
use App\Repositories\BaseRepositoryInterface;

interface LanguageRepositoryInterface extends BaseRepositoryInterface
{
    public function getByName(string $name): Language;
}
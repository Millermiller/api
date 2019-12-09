<?php

namespace App\Repositories\Word;

use App\Repositories\BaseRepositoryInterface;

interface WordRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return int
     */
    public function countAudio(): int;
}
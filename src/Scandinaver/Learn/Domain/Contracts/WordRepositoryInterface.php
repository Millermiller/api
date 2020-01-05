<?php

namespace Scandinaver\Learn\Domain\Contracts;

use App\Repositories\BaseRepositoryInterface;

interface WordRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return int
     */
    public function countAudio(): int;
}
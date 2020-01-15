<?php


namespace Scandinaver\Learn\Domain\Contracts;

use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Interface WordRepositoryInterface
 * @package Scandinaver\Learn\Domain\Contracts
 */
interface WordRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return int
     */
    public function countAudio(): int;
}
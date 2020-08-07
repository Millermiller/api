<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface TranslateRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface TranslateRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param  array  $ids
     *
     * @return array
     */
    public function searchByIds(array $ids): array;
}
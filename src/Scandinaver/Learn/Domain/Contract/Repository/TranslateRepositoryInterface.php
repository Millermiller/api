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
    public function searchByIds(array $ids): array;
}
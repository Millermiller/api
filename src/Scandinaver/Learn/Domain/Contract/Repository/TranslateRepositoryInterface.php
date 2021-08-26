<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Learn\Domain\Entity\Translate;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface TranslateRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Translate>
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface TranslateRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByIds(array $ids): array;
}
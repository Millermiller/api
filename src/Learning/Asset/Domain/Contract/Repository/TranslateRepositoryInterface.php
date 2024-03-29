<?php


namespace Scandinaver\Learning\Asset\Domain\Contract\Repository;

use Scandinaver\Learning\Asset\Domain\Entity\Translate;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;

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
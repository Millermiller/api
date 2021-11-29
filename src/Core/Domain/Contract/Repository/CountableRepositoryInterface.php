<?php


namespace Scandinaver\Core\Domain\Contract\Repository;


use Scandinaver\Common\Domain\Entity\Language;

/**
 * Interface CountableRepositoryInterface
 *
 * @package Scandinaver\Core\Domain\Contract\Repository
 */
interface CountableRepositoryInterface
{
    public function getCountByLanguage(Language $language): int;
}
<?php


namespace Scandinaver\Common\Domain\Contract\Repository;


use Scandinaver\Common\Domain\Entity\Language;

/**
 * Interface CountableRepositoryInterface
 *
 * @package Scandinaver\Common\Domain\Contract\Repository
 */
interface CountableRepositoryInterface
{
    public function getCountByLanguage(Language $language): int;
}
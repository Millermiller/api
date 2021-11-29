<?php


namespace Scandinaver\Core\Domain\Contract\Repository;


use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Core\Domain\Contract\LearnItemInterface;

/**
 * Interface HasLevelRepositoryInterface
 *
 * @template T
 * @package  Scandinaver\Common\Domain\Contract\Repository
 */
interface HasLevelRepositoryInterface
{

    /**
     * @param  Language  $language
     *
     * @return T
     */
    public function getFirstLevel(Language $language): LearnItemInterface;

    /**
     * @param  Language  $language
     *
     * @return T
     */
    public function getLastLevel(Language $language): LearnItemInterface;

    /**
     * @param  T  $entity
     *
     * @return T
     */
    public function getNextLevel(LearnItemInterface $entity): ?LearnItemInterface;
}
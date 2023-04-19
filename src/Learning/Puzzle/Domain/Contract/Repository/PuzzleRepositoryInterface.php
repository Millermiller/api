<?php


namespace Scandinaver\Learning\Puzzle\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;

/**
 * Interface PuzzleRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Puzzle>
 * @package Scandinaver\Puzzle\Domain\Contract
 */
interface PuzzleRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

    /**
     * @param  Language  $language
     *
     * @return Puzzle[]
     */
    public function getByLanguage(Language $language): array;

    /**
     * @param  Language       $language
     * @param  UserInterface  $user
     *
     * @return Puzzle[]
     */
    public function getForUser(Language $language, UserInterface $user): array;

    public function addForUser(UserInterface $user, Puzzle $puzzle): void;
}
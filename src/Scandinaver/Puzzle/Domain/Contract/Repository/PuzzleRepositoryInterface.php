<?php


namespace Scandinaver\Puzzle\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface PuzzleRepositoryInterface
 *
 * @package Scandinaver\Puzzle\Domain\Contract
 */
interface PuzzleRepositoryInterface extends BaseRepositoryInterface
{

    /**
     * @param  Language  $language
     *
     * @return mixed
     */
    public function getByLanguage(Language $language);

    public function getForUser(Language $language, UserInterface $user): array;

    public function addForUser(UserInterface $user, Puzzle $puzzle): void;
}
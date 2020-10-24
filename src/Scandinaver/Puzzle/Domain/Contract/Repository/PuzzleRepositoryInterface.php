<?php


namespace Scandinaver\Puzzle\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Interface PuzzleRepositoryInterface
 *
 * @package Scandinaver\Puzzle\Domain\Contract
 */
interface PuzzleRepositoryInterface extends BaseRepositoryInterface
{
    public function getByLanguage(Language $language);

    public function getForUser(Language $language, User $user): array;

    public function addForUser(User $user, Puzzle $puzzle): void;
}
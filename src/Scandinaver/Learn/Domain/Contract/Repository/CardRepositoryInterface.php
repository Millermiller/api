<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Interface CardRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface CardRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param  User  $user
     *
     * @return mixed
     */
    public function getForUser(User $user): array;

    /**
     * @param  Language  $language
     *
     * @return array
     */
    public function getByLanguage(Language $language): array;
}
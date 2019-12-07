<?php

namespace App\Repositories\Card;

use App\Entities\{Language, User};
use App\Repositories\BaseRepositoryInterface;

/**
 * Interface TextRepositoryInterface
 * @package App\Repositories\Text
 */
interface CardRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param User $user
     * @return mixed
     */
    public function getForUser(User $user): array;

    /**
     * @param Language $language
     * @return array
     */
    public function getByLanguage(Language $language) : array;
}
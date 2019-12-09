<?php

namespace App\Repositories\Text;

use App\Entities\{Text, Language, User};
use App\Repositories\BaseRepositoryInterface;

/**
 * Interface TextRepositoryInterface
 * @package App\Repositories\Text
 */
interface TextRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Language $language
     * @return Text
     */
    public function getFirstText(Language $language): Text;

    /**
     * @param User $user
     * @return mixed
     */
    public function getForUser(User $user): array;

    /**
     * @param User $user
     * @param Language $language
     * @return array
     */
    public function getActiveIds(User $user, Language $language): array;

    /**
     * @param Language $language
     * @return array
     */
    public function getByLanguage(Language $language): array;

    /**
     * @param Text $text
     * @param Language $language
     * @return Text
     */
    public function getNextText(Text $text, Language $language): Text;
}
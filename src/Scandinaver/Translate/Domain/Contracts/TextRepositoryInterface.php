<?php


namespace Scandinaver\Translate\Domain\Contracts;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\Text;
use Scandinaver\User\Domain\User;

/**
 * Interface TextRepositoryInterface
 *
 * @package Scandinaver\Translate\Domain;
 */
interface TextRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Language $language
     *
     * @return Text
     */
    public function getFirstText(Language $language): Text;

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function getForUser(User $user): array;

    /**
     * @param User     $user
     * @param Language $language
     *
     * @return array
     */
    public function getActiveIds(User $user, Language $language): array;

    /**
     * @param Language $language
     *
     * @return array
     */
    public function getByLanguage(Language $language): array;

    /**
     * @param Text     $text
     * @param Language $language
     *
     * @return Text
     */
    public function getNextText(Text $text, Language $language): Text;

    /**
     * @param Language $language
     *
     * @return int
     */
    public function getCountByLanguage(Language $language): int;
}
<?php


namespace Scandinaver\Text\Domain\Contracts;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Text\Domain\Text;
use Scandinaver\User\Domain\User;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Interface TextRepositoryInterface
 * @package Scandinaver\Text\Domain;
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

    /**
     * @param Language $language
     * @return int
     */
    public function getCountByLanguage(Language $language): int;
}
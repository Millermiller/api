<?php


namespace Scandinaver\Translate\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\User\Domain\Model\User;

/**
 * Interface TextRepositoryInterface
 *
 * @package Scandinaver\Translate\Domain\Contract\Repository
 */
interface TextRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param  Language  $language
     *
     * @return Text
     */
    public function getFirstText(Language $language): Text;

    /**
     * @param  User  $user
     *
     * @return mixed
     */
    public function getForUser(User $user): array;

    /**
     * @param  User      $user
     * @param  Language  $language
     *
     * @return array
     */
    public function getActiveIds(User $user, Language $language): array;

    /**
     * @param  Language  $language
     *
     * @return array
     */
    public function getByLanguage(Language $language): array;

    /**
     * @param  Text      $text
     * @param  Language  $language
     *
     * @return Text
     */
    public function getNextText(Text $text, Language $language): Text;

    /**
     * @param  Language  $language
     *
     * @return int
     */
    public function getCountByLanguage(Language $language): int;
}
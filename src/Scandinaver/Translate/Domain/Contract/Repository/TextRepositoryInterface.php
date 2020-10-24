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
    public function getFirstText(Language $language): Text;

    public function getForUser(User $user): array;

    public function getActiveIds(User $user, Language $language): array;

    public function getByLanguage(Language $language): array;

    public function getNextText(Text $text): Text;

    public function getCountByLanguage(Language $language): int;
}
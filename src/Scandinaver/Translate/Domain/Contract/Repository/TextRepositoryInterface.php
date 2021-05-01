<?php


namespace Scandinaver\Translate\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\Model\Text;

/**
 * Interface TextRepositoryInterface
 *
 * @package Scandinaver\Translate\Domain\Contract\Repository
 */
interface TextRepositoryInterface extends BaseRepositoryInterface
{
    public function getFirstText(Language $language): Text;

    public function getForUser(UserInterface $user): array;

    public function getActiveIds(UserInterface $user, Language $language): array;

    public function getByLanguage(Language $language): array;

    public function getNextText(Text $text): Text;

    public function getCountByLanguage(Language $language): int;
}
<?php


namespace Scandinaver\Translate\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\Entity\Text;

/**
 * Interface TextRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Text>
 * @package Scandinaver\Translate\Domain\Contract\Repository
 */
interface TextRepositoryInterface extends BaseRepositoryInterface
{
    public function getFirstText(Language $language): Text;

    /**
     * @param  UserInterface  $user
     *
     * @return Text[]
     */
    public function getForUser(UserInterface $user): array;

    /**
     * @param  Language  $language
     *
     * @return Text[]
     */
    public function getByLanguage(Language $language): array;

    public function getNextText(Text $text): Text;

    public function getCountByLanguage(Language $language): int;
}
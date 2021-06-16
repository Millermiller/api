<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface CardRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface CardRepositoryInterface extends BaseRepositoryInterface
{
    public function getForUser(UserInterface $user): array;

    public function getByLanguage(Language $language): array;

    public function getSentences(Language $language): array;
}
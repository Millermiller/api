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
    public function getForUser(User $user): array;

    public function getByLanguage(Language $language): array;

    public function getSentences(Language $language): array;

    /**
     * @param  Language  $language
     * @param  string    $word
     * @param  bool      $sentence
     *
     * @return mixed
     */
    public function search(Language $language, string $word, bool $sentence);
}
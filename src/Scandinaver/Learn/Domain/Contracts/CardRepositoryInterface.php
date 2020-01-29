<?php


namespace Scandinaver\Learn\Domain\Contracts;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;
use Scandinaver\User\Domain\User;

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
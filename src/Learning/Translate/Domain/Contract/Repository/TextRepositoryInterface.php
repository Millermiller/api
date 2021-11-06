<?php


namespace Scandinaver\Learning\Translate\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Domain\Contract\Repository\CountableRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\HasLevelRepositoryInterface;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Entity\Text;

/**
 * Interface TextRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Text>
 * @package Scandinaver\Translate\Domain\Contract\Repository
 */
interface TextRepositoryInterface extends BaseRepositoryInterface, CountableRepositoryInterface, HasLevelRepositoryInterface
{
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
}
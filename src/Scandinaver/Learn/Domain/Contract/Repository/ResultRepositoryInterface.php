<?php


namespace Scandinaver\Learn\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\{Asset, Result};
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Interface ResultRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface ResultRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveIds(User $user, Language $language): array;

    public function getResult(User $user, Asset $asset): ?Result;
}
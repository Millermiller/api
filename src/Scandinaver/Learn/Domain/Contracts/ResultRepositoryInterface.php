<?php


namespace Scandinaver\Learn\Domain\Contracts;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\{Asset, Result};
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;
use Scandinaver\User\Domain\User;

/**
 * Interface ResultRepositoryInterface
 *
 * @package Scandinaver\Learn\Domain\Contracts
 */
interface ResultRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveIds(User $user, Language $language): array;

    public function getResult(User $user, Asset $asset): Result;
}
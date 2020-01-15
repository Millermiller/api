<?php


namespace Scandinaver\Learn\Domain\Contracts;

use Scandinaver\Learn\Domain\{Asset, Result};
use Scandinaver\Common\Domain\Language;
use Scandinaver\User\Domain\User;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Interface ResultRepositoryInterface
 * @package Scandinaver\Learn\Domain\Contracts
 */
interface ResultRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveIds(User $user, Language $language): array;

    public function getResult(User $user, Asset $asset): Result;
}
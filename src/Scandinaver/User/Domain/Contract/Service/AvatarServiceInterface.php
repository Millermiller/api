<?php


namespace Scandinaver\User\Domain\Contract\Service;

use Scandinaver\User\Domain\Model\User;

/**
 * Interface AvatarServiceInterface
 *
 * @package Scandinaver\User\Domain\Contract\Service
 */
interface AvatarServiceInterface
{
    /**
     * @param  User  $user
     *
     * @return mixed
     */
    public function getAvatar(User $user): string;
}
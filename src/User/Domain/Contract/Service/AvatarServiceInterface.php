<?php


namespace Scandinaver\User\Domain\Contract\Service;

use Scandinaver\Core\Domain\Contract\UserInterface;

/**
 * Interface AvatarServiceInterface
 *
 * @package Scandinaver\User\Domain\Contract\Service
 */
interface AvatarServiceInterface
{

    /**
     * @param  UserInterface  $user
     *
     * @return mixed
     */
    public function getAvatar(UserInterface $user): string;
}
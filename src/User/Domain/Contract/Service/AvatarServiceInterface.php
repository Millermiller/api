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

    public function getAvatar(UserInterface $user): string;
}
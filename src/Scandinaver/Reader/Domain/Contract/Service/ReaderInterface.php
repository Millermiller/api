<?php


namespace Scandinaver\Reader\Domain\Contract\Service;

use Scandinaver\User\Domain\Model\User;

/**
 * Interface ReaderInterface
 *
 * @package Scandinaver\Reader\Domain\Contract\Service
 */
interface ReaderInterface
{
    public function read(User $user, string $language, string $text);
}
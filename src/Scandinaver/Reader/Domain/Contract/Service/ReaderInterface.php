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

    /**
     * @param  User    $user
     * @param  string  $language
     * @param  string  $text
     *
     * @return mixed
     */
    public function read(User $user, string $language, string $text): string;
}
<?php


namespace Scandinaver\Reader\Domain\Contract\Service;

use Scandinaver\Common\Domain\Contract\UserInterface;

/**
 * Interface ReaderInterface
 *
 * @package Scandinaver\Reader\Domain\Contract\Service
 */
interface ReaderInterface
{

    /**
     * @param  UserInterface  $user
     * @param  string         $language
     * @param  string         $text
     *
     * @return mixed
     */
    public function read(UserInterface $user, string $language, string $text): string;
}
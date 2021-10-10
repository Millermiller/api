<?php


namespace Scandinaver\Common\Domain\Contract;


use Scandinaver\Common\Domain\Entity\Language;

/**
 * Interface LearnItemInterface
 *
 * @package Scandinaver\Common\Domain\Contract
 */
interface LearnItemInterface
{

    public function getLevel(): int;

    public function getLanguage(): Language;
}
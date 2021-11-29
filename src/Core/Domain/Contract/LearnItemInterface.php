<?php


namespace Scandinaver\Core\Domain\Contract;


use Scandinaver\Common\Domain\Entity\Language;

/**
 * Interface LearnItemInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface LearnItemInterface
{

    public function getLevel(): int;

    public function getLanguage(): Language;
}
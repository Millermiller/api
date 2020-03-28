<?php


namespace Scandinaver\Common\Domain\Contracts;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Interface LanguageRepositoryInterface
 *
 * @package Scandinaver\Common\Domain\Contracts
 */
interface LanguageRepositoryInterface extends BaseRepositoryInterface
{
    public function getByName(string $name): Language;
}
<?php


namespace Scandinaver\Common\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface LanguageRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Language>
 * @package Scandinaver\Common\Domain\Contract
 */
interface LanguageRepositoryInterface extends BaseRepositoryInterface
{
    public function getByName(string $letter): Language;
}
<?php


namespace Scandinaver\Common\Domain\Contract\Repository;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

/**
 * Interface LanguageRepositoryInterface
 *
 * @package Scandinaver\Common\Domain\Contract
 */
interface LanguageRepositoryInterface extends BaseRepositoryInterface
{

    public function getByName(string $name): Language;

}
<?php


namespace Scandinaver\Learn\Domain\Contracts;

use Scandinaver\Shared\Contracts\BaseRepositoryInterface;

/**
 * Interface TranslateRepositoryInterface
 * @package Scandinaver\Learn\Domain\Contracts
 */
interface TranslateRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByIds(array $ids);
}
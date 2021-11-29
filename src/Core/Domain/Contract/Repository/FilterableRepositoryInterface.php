<?php


namespace Scandinaver\Core\Domain\Contract\Repository;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Interface FilterableRepositoryInterface
 *
 * @package Scandinaver\Core\Domain\Contract\Repository
 */
interface FilterableRepositoryInterface
{
    public function getData(RequestParametersComposition $parameters): LengthAwarePaginator;
}
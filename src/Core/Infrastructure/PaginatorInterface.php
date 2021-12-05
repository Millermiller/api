<?php


namespace Scandinaver\Core\Infrastructure;

/**
 * Interface PaginatorInterface
 *
 * @package Scandinaver\Core\Infrastructure
 */
interface PaginatorInterface
{

    public function getUrlRange(int $start, int $end): array;

    public function total(): int;

    public function lastPage(): int;
}
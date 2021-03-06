<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class MetaQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
class MetaQuery implements QueryInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
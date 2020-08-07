<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class MetaQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
class MetaQuery implements Query
{
    private int $id;

    /**
     * MetaQuery constructor.
     *
     * @param  int  $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
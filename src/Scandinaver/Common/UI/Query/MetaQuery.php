<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class MetaQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
class MetaQuery implements CommandInterface
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
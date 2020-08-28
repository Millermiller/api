<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class IntroQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
class IntroQuery implements Query
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
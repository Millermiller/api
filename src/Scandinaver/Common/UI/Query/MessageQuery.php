<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class MessageQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
class MessageQuery implements Query
{
    private int $id;

    /**
     * MessageQuery constructor.
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
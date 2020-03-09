<?php


namespace Scandinaver\Common\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class MessageQuery
 * @package Scandinaver\Common\Application\Query
 */
class MessageQuery implements Query
{
    /**
     * @var integer
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
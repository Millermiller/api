<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class MessageQuery
 *
 * @see     \Scandinaver\Common\Application\Handler\Query\MessageHandler
 * @package Scandinaver\Common\UI\Query
 */
class MessageQuery implements QueryInterface
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
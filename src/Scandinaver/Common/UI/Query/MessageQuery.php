<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class MessageQuery
 *
 * @see     \Scandinaver\Common\Application\Handler\Query\MessageHandler
 * @package Scandinaver\Common\UI\Query
 */
class MessageQuery implements CommandInterface
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
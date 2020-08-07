<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MessageHandlerInterface;
use Scandinaver\Common\UI\Query\MessageQuery;

/**
 * Class MessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessageHandler implements MessageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  MessageQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
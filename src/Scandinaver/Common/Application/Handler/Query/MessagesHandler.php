<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MessagesHandlerInterface;
use Scandinaver\Common\UI\Query\MessagesQuery;

/**
 * Class MessagesHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessagesHandler implements MessagesHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  MessagesQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
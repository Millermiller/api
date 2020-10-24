<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MessagesHandlerInterface;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Query\MessagesQuery;

/**
 * Class MessagesHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessagesHandler implements MessagesHandlerInterface
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * @param MessagesQuery $query
     */
    public function handle($query)
    {
        return $this->messageService->all();
    }
} 
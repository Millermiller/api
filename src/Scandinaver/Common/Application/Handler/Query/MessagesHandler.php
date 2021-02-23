<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MessagesHandlerInterface;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Query\MessagesQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  MessagesQuery|Query  $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->messageService->all();
    }
} 
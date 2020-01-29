<?php


namespace Scandinaver\Common\Application\Handlers;

use Scandinaver\Common\Application\Query\MessagesQuery;
use Scandinaver\Common\Domain\Services\MessageService;

/**
 * Class MessagesHandler
 * @package Scandinaver\Common\Application\Handlers
 */
class MessagesHandler implements MessagesHandlerInterface
{
    /**
     * @var MessageService
     */
    private $messageService;

    /**
     * MessagesHandler constructor.
     * @param MessageService $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * @param MessagesQuery $query
     * @return array
     */
    public function handle($query): array
    {
        return $this->messageService->all();
    }
}
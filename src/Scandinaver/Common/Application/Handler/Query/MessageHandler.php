<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MessageHandlerInterface;
use Scandinaver\Common\Domain\Model\MessageDTO;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Query\MessageQuery;

/**
 * Class MessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessageHandler implements MessageHandlerInterface
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * @param  MessageQuery  $query
     *
     * @return MessageDTO
     */
    public function handle($query)
    {
        return $this->messageService->one($query->getId());
    }
} 
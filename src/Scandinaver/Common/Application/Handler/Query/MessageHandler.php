<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MessageHandlerInterface;
use Scandinaver\Common\Domain\Exception\MessageNotFoundException;
use Scandinaver\Common\Domain\Model\MessageDTO;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Query\MessageQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  MessageQuery|Query  $query
     *
     * @return MessageDTO
     * @throws MessageNotFoundException
     */
    public function handle($query): MessageDTO
    {
        return $this->messageService->one($query->getId());
    }
} 
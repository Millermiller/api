<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MessageHandlerInterface;
use Scandinaver\Common\Domain\Exception\MessageNotFoundException;
use Scandinaver\Common\Domain\Model\MessageDTO;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Query\MessageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class MessageHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessageHandler extends AbstractHandler implements MessageHandlerInterface
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        parent::__construct();

        $this->messageService = $messageService;
    }

    /**
     * @param  MessageQuery|Query  $query
     *
     * @return MessageDTO
     * @throws MessageNotFoundException
     */
    public function handle($query): void
    {
        // TODO: implement messages
        // return $this->messageService->one($query->getId());
    }
} 
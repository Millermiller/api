<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Exception\MessageNotFoundException;
use Scandinaver\Common\Domain\Model\MessageDTO;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Query\MessageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class MessageQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessageQueryHandler extends AbstractHandler
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        parent::__construct();

        $this->messageService = $messageService;
    }

    /**
     * @param  MessageQuery|CommandInterface  $query
     *
     */
    public function handle(CommandInterface $query): void
    {
        // TODO: implement messages
        // return $this->messageService->one($query->getId());
    }
} 
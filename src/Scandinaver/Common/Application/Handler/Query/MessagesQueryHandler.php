<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Service\MessageService;
use Scandinaver\Common\UI\Query\MessagesQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class MessagesQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessagesQueryHandler extends AbstractHandler
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        parent::__construct();

        $this->messageService = $messageService;
    }

    /**
     * @param  MessagesQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: implement messages
        //return $this->messageService->all();
    }
} 
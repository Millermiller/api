<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\MessagesHandlerInterface;
use Scandinaver\Common\Domain\Services\MessageService;
use Scandinaver\Common\UI\Query\MessagesQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class MessagesHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessagesHandler extends AbstractHandler implements MessagesHandlerInterface
{

    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        parent::__construct();

        $this->messageService = $messageService;
    }

    /**
     * @param  MessagesQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: implement messages
        //return $this->messageService->all();
    }
} 
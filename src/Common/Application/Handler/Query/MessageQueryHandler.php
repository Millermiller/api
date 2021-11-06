<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Service\MessageService;
use Scandinaver\Common\UI\Query\MessageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  MessageQuery|BaseCommandInterface  $query
     *
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: implement messages
        // return $this->messageService->one($query->getId());
    }
} 
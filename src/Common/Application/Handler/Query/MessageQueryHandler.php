<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Service\MessageService;
use Scandinaver\Common\UI\Query\MessageQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class MessageQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MessageQueryHandler extends AbstractHandler
{

    public function __construct(private MessageService $service)
    {
        parent::__construct();

    }

    /**
     * @param  MessageQuery  $query
     *
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: implement messages
        // return $this->messageService->one($query->getId());
    }
} 
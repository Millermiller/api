<?php


namespace Scandinaver\Text\Application\Handlers;

use Doctrine\DBAL\DBALException;
use Scandinaver\Text\Application\Query\GetTextQuery;
use Scandinaver\Text\Domain\TextService;

/**
 * Class GetTextHandler
 *
 * @package Scandinaver\Text\Application\Handlers
 */
class GetTextHandler implements GetTextHandlerInterface
{
    /**
     * @var TextService
     */
    private $textService;

    /**
     * TextController constructor.
     *
     * @param TextService $textService
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param GetTextQuery
     *
     * @inheritDoc
     * @throws DBALException
     */
    public function handle($query)
    {
        return $this->textService->prepareText($query->getText());
    }
} 
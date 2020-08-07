<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Doctrine\DBAL\DBALException;
use Scandinaver\Translate\Domain\Contract\Query\GetTextHandlerInterface;
use Scandinaver\Translate\Domain\TextService;
use Scandinaver\Translate\UI\Query\GetTextQuery;

/**
 * Class GetTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class GetTextHandler implements GetTextHandlerInterface
{
    private TextService $textService;

    /**
     * TextController constructor.
     *
     * @param  TextService  $textService
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param  GetTextQuery
     *
     * @throws DBALException
     */
    public function handle($query)
    {
        return $this->textService->prepareText($query->getText());
    }
} 
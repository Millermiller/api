<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Scandinaver\Translate\Domain\TextService;
use Scandinaver\Translate\UI\Query\GetTextsQuery;
use Scandinaver\Translate\Domain\Contract\Query\GetTextsHandlerInterface;

/**
 * Class GetTextsHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetTextsHandler implements GetTextsHandlerInterface
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param  GetTextsQuery  $query
     *
     * @return array
     */
    public function handle($query)
    {
        return $this->textService->getAllByLanguage($query->getLanguage());
    }
} 
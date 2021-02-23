<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Translate\Domain\Contract\Query\GetTextsHandlerInterface;
use Scandinaver\Translate\Domain\TextService;
use Scandinaver\Translate\UI\Query\GetTextsQuery;

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
     * @param  GetTextsQuery|Query  $query
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function handle($query): array
    {
        return $this->textService->getAllByLanguage($query->getLanguage());
    }
} 
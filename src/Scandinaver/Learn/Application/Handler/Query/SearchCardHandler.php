<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Learn\UI\Query\SearchCardQuery;
use Scandinaver\Learn\Domain\Contract\Query\SearchCardHandlerInterface;

/**
 * Class SearchCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class SearchCardHandler implements SearchCardHandlerInterface
{

    private CardService $service;

    public function __construct(CardService $service)
    {

        $this->service = $service;
    }

    /**
     * @param  SearchCardQuery|Query  $query
     *
     * @return array|Card[]
     * @throws LanguageNotFoundException
     */
    public function handle($query): array
    {
        return $this->service->search($query->getLanguage(), $query->getQuery(), $query->getIsSentence());
    }
} 
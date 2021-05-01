<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Resources\CardTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Learn\UI\Query\SearchCardQuery;

/**
 * Class SearchCardQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class SearchCardQueryHandler extends AbstractHandler
{
    private CardService $service;

    public function __construct(CardService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  SearchCardQuery|CommandInterface  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $cards = $this->service->search($query->getLanguage(), $query->getQuery(), $query->getIsSentence());

        $this->resource = new Collection($cards, new CardTransformer());
    }
} 
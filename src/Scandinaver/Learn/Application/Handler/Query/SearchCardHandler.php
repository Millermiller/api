<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Resources\CardTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Learn\UI\Query\SearchCardQuery;
use Scandinaver\Learn\Domain\Contract\Query\SearchCardHandlerInterface;

/**
 * Class SearchCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class SearchCardHandler extends AbstractHandler implements SearchCardHandlerInterface
{

    private CardService $service;

    public function __construct(CardService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  SearchCardQuery|Query  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle($query): void
    {
        $cards = $this->service->search($query->getLanguage(), $query->getQuery(), $query->getIsSentence());

        $this->resource = new Collection($cards, new CardTransformer());
    }
} 
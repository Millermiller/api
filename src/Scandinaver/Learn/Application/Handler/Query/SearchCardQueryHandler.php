<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Service\CardService;
use Scandinaver\Learn\UI\Resource\CardTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
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
     * @param  SearchCardQuery|BaseCommandInterface  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $cards = $this->service->search($query->getLanguage(), $query->getQuery(), $query->getIsSentence());

        $this->resource = new Collection($cards, new CardTransformer());
    }
} 
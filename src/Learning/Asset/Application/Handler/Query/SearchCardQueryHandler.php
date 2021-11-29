<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Query\SearchCardQuery;
use Scandinaver\Learning\Asset\UI\Resource\CardTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class SearchCardQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class SearchCardQueryHandler extends AbstractHandler
{

    public function __construct(private CardService $service)
    {
        parent::__construct();
    }

    /**
     * @param  SearchCardQuery  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $cards = $this->service->search($query->getLanguage(), $query->getQuery(), $query->getIsSentence());

        $this->resource = new Collection($cards, new CardTransformer());
    }
} 
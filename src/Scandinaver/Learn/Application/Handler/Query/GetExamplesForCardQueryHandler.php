<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Model\Example;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Query\GetExamplesForCardQuery;
use Scandinaver\Learn\UI\Resources\ExampleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class GetExamplesForCardQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetExamplesForCardQueryHandler extends AbstractHandler
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  GetExamplesForCardQuery|CommandInterface  $query
     */
    public function handle($query): void
    {
        $examples = $this->cardService->getExamples($query->getCard());

        $this->resource = new Collection($examples, new ExampleTransformer());
    }
} 
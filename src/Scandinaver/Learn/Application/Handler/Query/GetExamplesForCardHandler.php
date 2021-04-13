<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Contract\Query\GetExamplesForCardHandlerInterface;
use Scandinaver\Learn\Domain\Model\Example;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Query\GetExamplesForCardQuery;
use Scandinaver\Learn\UI\Resources\ExampleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetExamplesForCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetExamplesForCardHandler extends AbstractHandler extends AbstractHandler implements GetExamplesForCardHandlerInterface
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  GetExamplesForCardQuery|Query  $query
     *
     * @return Example[]|array
     */
    public function handle($query): array
    {
        $examples = $this->cardService->getExamples($query->getCard());

        $this->resource = new Collection($examples, new ExampleTransformer());

        return $this->processData();
    }
} 
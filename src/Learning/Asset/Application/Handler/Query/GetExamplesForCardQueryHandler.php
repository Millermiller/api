<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Query\GetExamplesForCardQuery;
use Scandinaver\Learning\Asset\UI\Resource\ExampleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetExamplesForCardQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetExamplesForCardQueryHandler extends AbstractHandler
{

    public function __construct(private CardService $cardService)
    {
        parent::__construct();
    }

    /**
     * @param  GetExamplesForCardQuery  $query
     *
     * @throws CardNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $examples = $this->cardService->getExamples($query->getCard());

        $this->resource = new Collection($examples, new ExampleTransformer());
    }
} 
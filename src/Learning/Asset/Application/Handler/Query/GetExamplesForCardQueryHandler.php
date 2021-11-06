<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Entity\Example;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Query\GetExamplesForCardQuery;
use Scandinaver\Learning\Asset\UI\Resource\ExampleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
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
     * @param  GetExamplesForCardQuery|BaseCommandInterface  $query
     *
     * @throws CardNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $examples = $this->cardService->getExamples($query->getCard());

        $this->resource = new Collection($examples, new ExampleTransformer());
    }
} 
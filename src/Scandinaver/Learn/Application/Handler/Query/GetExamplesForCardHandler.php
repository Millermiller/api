<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Doctrine\Common\Collections\Collection;
use Scandinaver\Learn\Domain\Contract\Query\GetExamplesForCardHandlerInterface;
use Scandinaver\Learn\Domain\Model\Example;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Query\GetExamplesForCardQuery;

/**
 * Class GetExamplesForCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetExamplesForCardHandler implements GetExamplesForCardHandlerInterface
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param  GetExamplesForCardQuery
     *
     * @return Collection|Example[]|array
     */
    public function handle($query): array
    {
        return $this->cardService->getExamples($query->getCard());
    }
} 
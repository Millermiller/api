<?php


namespace Scandinaver\Learn\Application\Handlers;

use Doctrine\Common\Collections\Collection;
use Scandinaver\Learn\Application\Query\GetExamplesForCardQuery;
use Scandinaver\Learn\Domain\Example;
use Scandinaver\Learn\Domain\Services\CardService;

/**
 * Class GetExamplesForCardHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class GetExamplesForCardHandler implements GetExamplesForCardHandlerInterface
{
    /**
     * @var CardService
     */
    private $cardService;

    /**
     * GetTranslatesByWordHandler constructor.
     *
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param GetExamplesForCardQuery
     *
     * @return Collection|Example[]|array
     */
    public function handle($query): array
    {
        return $this->cardService->getExamples($query->getCard());
    }
} 
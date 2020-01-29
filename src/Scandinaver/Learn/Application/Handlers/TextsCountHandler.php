<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\AssetsCountQuery;
use Scandinaver\Text\Domain\TextService;

/**
 * Class TextCountHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class TextsCountHandler implements TextsCountHandlerInterface
{
    /**
     * @var TextService
     */
    private $textService;

    /**
     * TextCountHandler constructor.
     * @param TextService $textService
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param AssetsCountQuery $query
     * @return int
     */
    public function handle($query): int
    {
        return $this->textService->count($query->getLanguage());
    }
}
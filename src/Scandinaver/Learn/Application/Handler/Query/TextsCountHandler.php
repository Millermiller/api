<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\TextsCountHandlerInterface;
use Scandinaver\Learn\UI\Query\AssetsCountQuery;
use Scandinaver\Translate\Domain\TextService;

/**
 * Class TextCountHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TextsCountHandler implements TextsCountHandlerInterface
{
    /**
     * @var TextService
     */
    private TextService $textService;

    /**
     * TextCountHandler constructor.
     *
     * @param  TextService  $textService
     */
    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param  AssetsCountQuery  $query
     *
     * @return int
     */
    public function handle($query): int
    {
        return $this->textService->count();
    }
}
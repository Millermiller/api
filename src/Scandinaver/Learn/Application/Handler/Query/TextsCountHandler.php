<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Primitive;
use Scandinaver\Learn\Domain\Contract\Query\TextsCountHandlerInterface;
use Scandinaver\Learn\UI\Query\AssetsCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Translate\Domain\TextService;

/**
 * Class TextCountHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TextsCountHandler extends AbstractHandler implements TextsCountHandlerInterface
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  AssetsCountQuery|Query  $query
     *
     * @return int
     */
    public function handle($query): void
    {
        $count = $this->textService->count();

        $this->resource = new Primitive($count);
    }
}
<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Primitive;
use Scandinaver\Learn\Domain\Contract\Query\WordsCountHandlerInterface;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Query\WordsCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class WordsCountHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class WordsCountHandler extends AbstractHandler implements WordsCountHandlerInterface
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        parent::__construct();

        $this->wordService = $wordService;
    }

    /**
     * @param  WordsCountQuery|Query  $query
     */
    public function handle($query): void
    {
        $count = $this->wordService->count();

        $this->resource = new Primitive($count);
    }
}
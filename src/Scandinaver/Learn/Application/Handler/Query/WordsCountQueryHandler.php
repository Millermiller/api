<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use Scandinaver\Learn\Domain\Service\WordService;
use Scandinaver\Learn\UI\Query\WordsCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class WordsCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class WordsCountQueryHandler extends AbstractHandler
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        parent::__construct();

        $this->wordService = $wordService;
    }

    /**
     * @param  WordsCountQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $count = $this->wordService->count();

        $this->resource =new Item($count, fn($data) => ['path' => $data]);
    }
}
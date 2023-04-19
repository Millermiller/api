<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Query\GetTextsQuery;
use Scandinaver\Learning\Translate\UI\Resource\TextTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetTextsQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetTextsQueryHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|GetTextsQuery  $query
     *
     */
    public function handle(BaseCommandInterface|GetTextsQuery $query): void
    {
        $data = $this->textService->paginate($query->getParameters());

        $this->resource = new Collection($data->items(), new TextTransformer(), 'text');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
} 
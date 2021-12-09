<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Query\IntrosQuery;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class IntrosQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntrosQueryHandler extends AbstractHandler
{

    public function __construct(private IntroService $service)
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|IntrosQuery $query): void
    {
        $data = $this->service->all($query->getParameters());

        $this->resource = new Collection($data->items(), new IntroTransformer());

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
}
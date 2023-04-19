<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Doctrine\ORM\Query\QueryException;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class LanguagesQueryHandler
 *
 * @package Scandinaver\API\Application\Handler\Query
 */
class LanguagesQueryHandler extends AbstractHandler
{

    public function __construct(private LanguageService $service)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|LanguagesQuery  $query
     *
     * @throws QueryException
     */
    public function handle(BaseCommandInterface|LanguagesQuery $query): void
    {
        $data = $this->service->paginate($query->getParameters());

        $this->resource = new Collection($data->items(), new LanguageTransformer(), 'roles');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
}
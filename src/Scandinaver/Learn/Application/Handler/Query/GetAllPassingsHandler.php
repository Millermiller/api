<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\TestService;
use Scandinaver\Learn\UI\Resources\PassingTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Learn\UI\Query\GetAllPassingsQuery;
use Scandinaver\Learn\Domain\Contract\Query\GetAllPassingsHandlerInterface;

/**
 * Class GetAllPassingsHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAllPassingsHandler extends AbstractHandler extends AbstractHandler implements GetAllPassingsHandlerInterface
{
    private TestService $service;

    public function __construct(TestService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  GetAllPassingsQuery|Query  $query
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function handle($query): array
    {
        $passings = $this->service->allByLanguage($query->getLanguage());

        $this->resource = new Collection($passings, new PassingTransformer());

        return $this->processData();
    }
} 
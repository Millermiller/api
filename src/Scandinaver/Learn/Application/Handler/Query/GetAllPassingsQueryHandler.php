<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Service\TestService;
use Scandinaver\Learn\UI\Resource\PassingTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Learn\UI\Query\GetAllPassingsQuery;

/**
 * Class GetAllPassingsQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAllPassingsQueryHandler extends AbstractHandler
{
    private TestService $service;

    public function __construct(TestService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  GetAllPassingsQuery|BaseCommandInterface  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $passings = $this->service->allByLanguage($query->getLanguage());

        $this->resource = new Collection($passings, new PassingTransformer());
    }
} 
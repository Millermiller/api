<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\TestService;
use Scandinaver\Learning\Asset\UI\Query\GetAllPassingsQuery;
use Scandinaver\Learning\Asset\UI\Resource\PassingTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetAllPassingsQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAllPassingsQueryHandler extends AbstractHandler
{

    public function __construct(private TestService $service)
    {
        parent::__construct();
    }

    /**
     * @param  GetAllPassingsQuery  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $passings = $this->service->allByLanguage($query->getLanguage());

        $this->resource = new Collection($passings, new PassingTransformer());
    }
} 
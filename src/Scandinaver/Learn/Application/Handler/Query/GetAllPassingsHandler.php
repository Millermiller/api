<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\TestService;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Learn\UI\Query\GetAllPassingsQuery;
use Scandinaver\Learn\Domain\Contract\Query\GetAllPassingsHandlerInterface;

/**
 * Class GetAllPassingsHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetAllPassingsHandler implements GetAllPassingsHandlerInterface
{
    private TestService $service;

    public function __construct(TestService $service)
    {
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
        return $this->service->allByLanguage($query->getLanguage());
    }
} 
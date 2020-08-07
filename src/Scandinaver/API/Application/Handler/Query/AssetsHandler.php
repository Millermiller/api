<?php


namespace Scandinaver\API\Application\Handler\Query;

use Exception;
use Scandinaver\API\Domain\ApiService;
use Scandinaver\API\Domain\Contract\Query\AssetsHandlerInterface;
use Scandinaver\API\UI\Query\AssetsQuery;

/**
 * Class AssetsHandler
 *
 * @package Scandinaver\API\Application\Handler\Query
 */
class AssetsHandler implements AssetsHandlerInterface
{
    /**
     * @var ApiService
     */
    private ApiService $apiService;

    /**
     * AssetsHandler constructor.
     *
     * @param  ApiService  $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @param  AssetsQuery  $query
     *
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->apiService->getAssets($query->getLanguage(), $query->getUser());
    }
}
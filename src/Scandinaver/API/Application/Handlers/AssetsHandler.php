<?php


namespace Scandinaver\API\Application\Handlers;

use Exception;
use Scandinaver\API\Application\Query\AssetsQuery;
use Scandinaver\API\Infrastructure\ApiService;

/**
 * Class AssetsHandler
 * @package Scandinaver\API\Application\Handlers
 */
class AssetsHandler implements AssetsHandlerInterface
{
    /**
     * @var ApiService
     */
    private $apiService;

    /**
     * AssetsHandler constructor.
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @param AssetsQuery $query
     * @return array
     * @throws Exception
     */
    public function handle($query): array
    {
        return $this->apiService->getAssets($query->getLanguage(), $query->getUser());
    }
}
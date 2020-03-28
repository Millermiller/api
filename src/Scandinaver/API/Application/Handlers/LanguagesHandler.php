<?php


namespace Scandinaver\API\Application\Handlers;

use Scandinaver\API\Application\Query\LanguagesQuery;
use Scandinaver\API\Infrastructure\ApiService;

/**
 * Class LanguagesHandler
 *
 * @package Scandinaver\API\Application\Handlers
 */
class LanguagesHandler implements LanguagesHandlerInterface
{
    /**
     * @var ApiService
     */
    private $apiService;

    /**
     * LanguagesHandler constructor.
     *
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @param LanguagesQuery $command
     *
     * @return array
     */
    public function handle($command): array
    {
        return $this->apiService->getLanguagesList();
    }
}
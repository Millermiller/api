<?php


namespace Scandinaver\API\Application\Handler\Query;

use Scandinaver\API\Domain\ApiService;
use Scandinaver\API\Domain\Contract\Query\LanguagesHandlerInterface;
use Scandinaver\API\UI\Query\LanguagesQuery;

/**
 * Class LanguagesHandler
 *
 * @package Scandinaver\API\Application\Handler\Query
 */
class LanguagesHandler implements LanguagesHandlerInterface
{
    /**
     * @var ApiService
     */
    private ApiService $apiService;

    /**
     * LanguagesHandler constructor.
     *
     * @param  ApiService  $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @param  LanguagesQuery  $command
     *
     * @return array
     */
    public function handle($command): array
    {
        return $this->apiService->getLanguagesList();
    }
}
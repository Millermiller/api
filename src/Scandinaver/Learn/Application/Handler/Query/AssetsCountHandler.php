<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\AssetsCountHandlerInterface;
use Scandinaver\Learn\Domain\Services\AudioService;
use Scandinaver\Learn\UI\Query\AssetsCountQuery;

/**
 * Class AssetsCountHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsCountHandler implements AssetsCountHandlerInterface
{
    /**
     * @var AudioService
     */
    private AudioService $audioService;

    /**
     * WordsCountHandler constructor.
     *
     * @param  AudioService  $audioService
     */
    public function __construct(AudioService $audioService)
    {
        $this->audioService = $audioService;
    }

    /**
     * @param  AssetsCountQuery  $query
     *
     * @return int
     */
    public function handle($query): int
    {
        return $this->audioService->count();
    }
}
<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\FindAudioQuery;
use Scandinaver\Learn\Domain\Services\AudioService;

/**
 * Class FindAudioHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class FindAudioHandler implements FindAudioHandlerInterface
{
    /**
     * @var AudioService
     */
    private $audioService;

    public function __construct(AudioService $audioService)
    {
        $this->audioService = $audioService;
    }

    /**
     * @param FindAudioQuery
     * @inheritDoc
     */
    public function handle($query)
    {
        return $this->audioService->parse($query->getWord());
    }
} 
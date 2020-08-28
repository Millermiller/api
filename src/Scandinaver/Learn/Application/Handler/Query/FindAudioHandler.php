<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\FindAudioHandlerInterface;
use Scandinaver\Learn\Domain\Services\AudioService;
use Scandinaver\Learn\UI\Query\FindAudioQuery;

/**
 * Class FindAudioHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class FindAudioHandler implements FindAudioHandlerInterface
{
    private AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        $this->audioService = $audioService;
    }

    /**
     * @param  FindAudioQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        return $this->audioService->parse($query->getWord());
    }
} 
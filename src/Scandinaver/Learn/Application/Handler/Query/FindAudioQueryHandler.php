<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Exceptions\WordNotFoundException;
use Scandinaver\Learn\Domain\Services\AudioService;
use Scandinaver\Learn\UI\Query\FindAudioQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class FindAudioQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class FindAudioQueryHandler extends AbstractHandler
{
    private AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        parent::__construct();

        $this->audioService = $audioService;
    }

    /**
     * @param  FindAudioQuery|CommandInterface  $query
     *
     * @throws WordNotFoundException
     */
    public function handle($query): void
    {
        $this->audioService->parse($query->getWord());
    }
} 
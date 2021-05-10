<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Exception\WordNotFoundException;
use Scandinaver\Learn\Domain\Service\AudioService;
use Scandinaver\Learn\UI\Query\FindAudioQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
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
     * @param  FindAudioQuery|BaseCommandInterface  $query
     *
     * @throws WordNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $this->audioService->parse($query->getWord());
    }
} 
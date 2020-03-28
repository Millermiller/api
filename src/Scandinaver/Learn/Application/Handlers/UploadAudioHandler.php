<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Commands\UploadAudioCommand;
use Scandinaver\Learn\Domain\Services\AudioService;

/**
 * Class UploadAudioHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class UploadAudioHandler implements UploadAudioHandlerInterface
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
     * @param UploadAudioCommand $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->audioService->upload($command->getWord(), $command->getFile());
    }
} 
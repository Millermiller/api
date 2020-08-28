<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\UploadAudioHandlerInterface;
use Scandinaver\Learn\Domain\Services\AudioService;
use Scandinaver\Learn\UI\Command\UploadAudioCommand;

/**
 * Class UploadAudioHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UploadAudioHandler implements UploadAudioHandlerInterface
{
    private AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        $this->audioService = $audioService;
    }

    /**
     * @param  UploadAudioCommand  $command
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        $this->audioService->upload($command->getWord(), $command->getFile());
    }
} 
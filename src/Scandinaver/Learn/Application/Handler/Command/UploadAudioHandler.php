<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Contract\Command\UploadAudioHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\WordNotFoundException;
use Scandinaver\Learn\Domain\Services\AudioService;
use Scandinaver\Learn\UI\Command\UploadAudioCommand;
use Scandinaver\Learn\UI\Resources\WordTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UploadAudioHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UploadAudioHandler extends AbstractHandler implements UploadAudioHandlerInterface
{
    private AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        parent::__construct();

        $this->audioService = $audioService;
    }

    /**
     * @param  UploadAudioCommand|Command  $command
     *
     * @throws WordNotFoundException
     */
    public function handle($command): void
    {
        $word = $this->audioService->upload($command->getWord(), $command->getFile());

        $this->resource = new Item($word, new WordTransformer());
    }
} 
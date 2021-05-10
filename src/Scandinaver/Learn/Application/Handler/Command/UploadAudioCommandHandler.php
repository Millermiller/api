<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Exception\WordNotFoundException;
use Scandinaver\Learn\Domain\Service\AudioService;
use Scandinaver\Learn\UI\Command\UploadAudioCommand;
use Scandinaver\Learn\UI\Resource\WordTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class UploadAudioCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UploadAudioCommandHandler extends AbstractHandler
{
    private AudioService $audioService;

    public function __construct(AudioService $audioService)
    {
        parent::__construct();

        $this->audioService = $audioService;
    }

    /**
     * @param  UploadAudioCommand|BaseCommandInterface  $command
     *
     * @throws WordNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $word = $this->audioService->upload($command->getWord(), $command->getFile());

        $this->resource = new Item($word, new WordTransformer());
    }
} 
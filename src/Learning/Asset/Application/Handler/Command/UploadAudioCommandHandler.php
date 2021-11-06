<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\TermNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AudioService;
use Scandinaver\Learning\Asset\UI\Command\UploadAudioCommand;
use Scandinaver\Learning\Asset\UI\Resource\TermTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class UploadAudioCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
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
     * @throws TermNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $term = $this->audioService->upload($command->getTermId(), $command->getFile());

        $this->resource = new Item($term, new TermTransformer());
    }
} 
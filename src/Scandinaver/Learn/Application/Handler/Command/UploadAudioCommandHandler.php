<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Exception\TermNotFoundException;
use Scandinaver\Learn\Domain\Service\AudioService;
use Scandinaver\Learn\UI\Command\UploadAudioCommand;
use Scandinaver\Learn\UI\Resource\TermTransformer;
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
     * @throws TermNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $term = $this->audioService->upload($command->getTermId(), $command->getFile());

        $this->resource = new Item($term, new TermTransformer());
    }
} 
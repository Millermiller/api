<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\TermNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\AudioService;
use Scandinaver\Learning\Asset\UI\Command\UploadAudioCommand;
use Scandinaver\Learning\Asset\UI\Resource\TermTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UploadAudioCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class UploadAudioCommandHandler extends AbstractHandler
{

    public function __construct(private AudioService $audioService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|UploadAudioCommand  $command
     *
     * @throws TermNotFoundException
     */
    public function handle(CommandInterface|UploadAudioCommand $command): void
    {
        $term = $this->audioService->upload($command->getTermId(), $command->getFile());

        $this->resource = new Item($term, new TermTransformer());
    }
} 
<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\DeleteTextCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class DeleteTextCommandHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  DeleteTextCommand  $command
     *
     * @throws TextNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->textService->deleteText($command->getId());

        $this->resource = new NullResource();
    }
} 
<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\CompleteTextCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CompleteTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class CompleteTextCommandHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|CompleteTextCommand  $command
     *
     * @throws TextNotFoundException
     */
    public function handle(CommandInterface|CompleteTextCommand $command): void
    {
        $this->textService->giveNextLevel($command->getUser(), $command->getText());

        $this->resource = new NullResource();
    }
} 
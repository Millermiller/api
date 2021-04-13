<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\CompleteTextHandlerInterface;
use Scandinaver\Translate\Domain\Services\TextService;
use Scandinaver\Translate\UI\Command\CompleteTextCommand;

/**
 * Class CompleteTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class CompleteTextHandler extends AbstractHandler implements CompleteTextHandlerInterface
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  CompleteTextCommand|Command  $command
     */
    public function handle($command): void
    {
        $this->textService->giveNextLevel($command->getUser(), $command->getText());

        $this->resource = new NullResource();
    }
} 
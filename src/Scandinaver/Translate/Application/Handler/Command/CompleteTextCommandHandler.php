<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\Translate\UI\Command\CompleteTextCommand;

/**
 * Class CompleteTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class CompleteTextCommandHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  CompleteTextCommand|BaseCommandInterface  $command
     *
     * @throws TextNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->textService->giveNextLevel($command->getUser(), $command->getText());

        $this->resource = new NullResource();
    }
} 
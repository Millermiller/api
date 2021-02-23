<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Contract\Command\CompleteTextHandlerInterface;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\TextService;
use Scandinaver\Translate\UI\Command\CompleteTextCommand;

/**
 * Class CompleteTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class CompleteTextHandler implements CompleteTextHandlerInterface
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    /**
     * @param  CompleteTextCommand|Command  $command
     *
     * @throws TextNotFoundException
     */
    public function handle($command): void
    {
        $this->textService->giveNextLevel($command->getUser(), $command->getText());
    }
} 
<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Service\CardService;
use Scandinaver\Learn\UI\Command\EditTranslateCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class EditTranslateCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class EditTranslateCommandHandler extends AbstractHandler
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  EditTranslateCommand|CommandInterface  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->cardService->editTranslate($command->getTranslate(), $command->getText());

        $this->cardService->deleteExamplesOfCard($command->getCard());

        $this->resource = new NullResource();
    }
} 
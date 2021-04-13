<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\EditTranslateHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\EditTranslateCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class EditTranslateHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class EditTranslateHandler extends AbstractHandler implements EditTranslateHandlerInterface
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  EditTranslateCommand|Command  $command
     *
     * @throws CardNotFoundException
     */
    public function handle($command): void
    {
        $this->cardService->editTranslate($command->getTranslate(), $command->getText());

        $this->cardService->deleteExamplesOfCard($command->getCard());

        $this->resource = new NullResource();
    }
} 
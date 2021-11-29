<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Command\EditTranslateCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class EditTranslateCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class EditTranslateCommandHandler extends AbstractHandler
{

    public function __construct(private CardService $cardService)
    {
        parent::__construct();
    }

    /**
     * @param  EditTranslateCommand  $command
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
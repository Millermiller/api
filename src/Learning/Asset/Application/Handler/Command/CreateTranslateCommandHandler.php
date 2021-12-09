<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Command\CreateTranslateCommand;
use Scandinaver\Learning\Asset\UI\Resource\ExampleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateTranslateCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class CreateTranslateCommandHandler extends AbstractHandler
{

    public function __construct(private CardService $cardService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|CreateTranslateCommand  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface|CreateTranslateCommand $command): void
    {
        $example = $this->cardService->addExample($command->getCard(), $command->getText(), $command->getValue());

        $this->resource = new Item($example, new ExampleTransformer());
    }
} 
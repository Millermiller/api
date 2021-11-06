<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Command\CreateTranslateCommand;
use Scandinaver\Learning\Asset\UI\Resource\ExampleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreateTranslateCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class CreateTranslateCommandHandler extends AbstractHandler
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  CreateTranslateCommand|BaseCommandInterface  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $example = $this->cardService->addExample($command->getCard(), $command->getText(), $command->getValue());

        $this->resource = new Item($example, new ExampleTransformer());
    }
} 
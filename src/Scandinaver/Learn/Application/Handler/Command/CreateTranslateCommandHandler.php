<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Service\CardService;
use Scandinaver\Learn\UI\Command\CreateTranslateCommand;
use Scandinaver\Learn\UI\Resource\ExampleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateTranslateCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
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
     * @param  CreateTranslateCommand|CommandInterface  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $example = $this->cardService->addExample($command->getCard(), $command->getText(), $command->getValue());

        $this->resource = new Item($example, new ExampleTransformer());
    }
} 
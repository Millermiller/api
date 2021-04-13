<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Contract\Command\CreateTranslateHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\CreateTranslateCommand;
use Scandinaver\Learn\UI\Resources\ExampleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateTranslateHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateTranslateHandler extends AbstractHandler implements CreateTranslateHandlerInterface
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  CreateTranslateCommand|Command  $command
     *
     * @throws CardNotFoundException
     */
    public function handle($command): void
    {
        $example = $this->cardService->addExample($command->getCard(), $command->getText(), $command->getValue());

        $this->resource = new Item($example, new ExampleTransformer());
    }
} 
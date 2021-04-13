<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Contract\Command\UpdateCardHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\UpdateCardCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UpdateCardHandler extends AbstractHandler implements UpdateCardHandlerInterface
{

    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  UpdateCardCommand|Command  $command
     *
     * @throws CardNotFoundException
     */
    public function handle($command): void
    {
        $this->cardService->updateCard($command->getCard(), $command->getData());

        $this->resource = new NullResource();
    }
} 
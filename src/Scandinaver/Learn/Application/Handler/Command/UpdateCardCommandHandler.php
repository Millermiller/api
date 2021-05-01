<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\UpdateCardCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateCardCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UpdateCardCommandHandler extends AbstractHandler
{
    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        parent::__construct();

        $this->cardService = $cardService;
    }

    /**
     * @param  UpdateCardCommand|CommandInterface  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->cardService->updateCard($command->getCard(), $command->getData());

        $this->resource = new NullResource();
    }
} 
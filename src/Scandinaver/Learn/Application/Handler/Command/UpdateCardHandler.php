<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use Scandinaver\Learn\Domain\Contract\Command\UpdateCardHandlerInterface;
use Scandinaver\Learn\Domain\Services\CardService;
use Scandinaver\Learn\UI\Command\UpdateCardCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCardHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class UpdateCardHandler implements UpdateCardHandlerInterface
{

    private CardService $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param  UpdateCardCommand|Command  $command
     */
    public function handle($command): void
    {
        $this->cardService->updateCard($command->getCard(), $command->getData());
    }
} 
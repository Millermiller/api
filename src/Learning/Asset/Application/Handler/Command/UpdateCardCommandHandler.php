<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Command\UpdateCardCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateCardCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class UpdateCardCommandHandler extends AbstractHandler
{

    public function __construct(private CardService $cardService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|UpdateCardCommand  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(CommandInterface|UpdateCardCommand $command): void
    {
        $this->cardService->updateCard($command->getCardId(), $command->buildDTO());

        $this->resource = new NullResource();
    }
} 
<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Service\CardService;
use Scandinaver\Learn\UI\Command\UpdateCardCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  UpdateCardCommand|BaseCommandInterface  $command
     *
     * @throws CardNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->cardService->updateCard($command->getCard(), $command->getData());

        $this->resource = new NullResource();
    }
} 
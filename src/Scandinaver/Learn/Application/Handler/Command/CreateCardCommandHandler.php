<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Service\CardService;
use Scandinaver\Learn\UI\Command\CreateCardCommand;
use Scandinaver\Learn\UI\Resource\CardTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreateCardCommandHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class CreateCardCommandHandler extends AbstractHandler
{
    private CardService $service;

    public function __construct(CardService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateCardCommand|BaseCommandInterface  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $card =  $this->service->createCard(
            $command->getUser(),
            $command->getLanguage(),
            $command->getWord(),
            $command->getTranslate()
        );

        $this->resource = new Item($card, new CardTransformer());
    }
} 
<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Asset\Domain\Service\CardService;
use Scandinaver\Learning\Asset\UI\Command\CreateCardCommand;
use Scandinaver\Learning\Asset\UI\Resource\CardTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateCardCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class CreateCardCommandHandler extends AbstractHandler
{

    public function __construct(private CardService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CreateCardCommand  $command
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $card = $this->service->createCard(
            $command->getUser(),
            $command->getLanguage(),
            $command->getWord(),
            $command->getTranslate()
        );

        $this->resource = new Item($card, new CardTransformer());
    }
} 
<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Translate\Domain\Exception\SynonymAlreadyExistsException;
use Scandinaver\Learning\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\UpdateTextCommand;
use Scandinaver\Learning\Translate\UI\Resource\TextTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class UpdateTextCommandHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|UpdateTextCommand  $command
     *
     * @throws SynonymAlreadyExistsException
     * @throws TextNotFoundException
     */
    public function handle(CommandInterface|UpdateTextCommand $command): void
    {
        $text = $this->textService->updateText($command->getId(), $command->buildDTO());

        $this->resource = new Item($text, new TextTransformer());
    }
} 
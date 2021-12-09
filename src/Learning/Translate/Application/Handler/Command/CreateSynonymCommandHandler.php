<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\CreateSynonymCommand;
use Scandinaver\Learning\Translate\UI\Resource\SynonymTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateSynonymCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateSynonymCommandHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  CommandInterface|CreateSynonymCommand  $command
     *
     * @throws Exception
     */
    public function handle(CommandInterface|CreateSynonymCommand $command): void
    {
        $synonym = $this->textService->createSynonym($command->buildDTO());

        $this->resource = new Item($synonym, new SynonymTransformer());
    }
} 
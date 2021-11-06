<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\CreateSynonymCommand;
use Scandinaver\Learning\Translate\UI\Resource\SynonymTransformer;

/**
 * Class CreateSynonymCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class CreateSynonymCommandHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();
        $this->textService = $textService;
    }

    /**
     * @param  CreateSynonymCommand|BaseCommandInterface  $command
     *
     * @throws Exception
     */
    public function handle(BaseCommandInterface $command): void
    {
        $synonym = $this->textService->createSynonym($command->buildDTO());

        $this->resource = new Item($synonym, new SynonymTransformer());
    }
} 
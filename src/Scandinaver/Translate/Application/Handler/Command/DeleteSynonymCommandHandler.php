<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\Translate\UI\Command\DeleteSynonymCommand;

/**
 * Class DeleteSynonymCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class DeleteSynonymCommandHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();
        $this->textService = $textService;
    }

    /**
     * @param  DeleteSynonymCommand|BaseCommandInterface  $command
     *
     * @throws Exception
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->textService->deleteSynonym($command->getId());

        $this->resource = new NullResource();
    }
} 
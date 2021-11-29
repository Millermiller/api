<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Command\DeleteSynonymCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteSynonymCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class DeleteSynonymCommandHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  DeleteSynonymCommand  $command
     *
     * @throws Exception
     */
    public function handle(CommandInterface $command): void
    {
        $this->textService->deleteSynonym($command->getId());

        $this->resource = new NullResource();
    }
} 
<?php


namespace Scandinaver\Translate\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\Translate\UI\Command\DeleteTextCommand;

/**
 * Class DeleteTextCommandHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Command
 */
class DeleteTextCommandHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  DeleteTextCommand|BaseCommandInterface  $command
     *
     * @throws TextNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->textService->deleteText($command->getId());

        $this->resource = new NullResource();
    }
} 
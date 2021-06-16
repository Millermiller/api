<?php


namespace Scandinaver\Learn\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learn\Domain\Service\TermService;
use Scandinaver\Learn\UI\Command\AddTermAndTranslateCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class AddTermAndTranslateCommand
 *
 * @package Scandinaver\Learn\Application\Handler\Command
 */
class AddTermAndTranslateCommandHandler extends AbstractHandler
{
    private TermService $termService;

    public function __construct(TermService $termService)
    {
        parent::__construct();

        $this->termService = $termService;
    }

    /**
     * @param  AddTermAndTranslateCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->termService->create(
            config('app.lang'),
            $command->getWord(),
            $command->getIssentence(),
            $command->getTranslate()
        );

        $this->resource = new NullResource();
    }
} 
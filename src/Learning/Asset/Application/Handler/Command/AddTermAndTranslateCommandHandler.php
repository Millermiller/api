<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Learning\Asset\Domain\Service\TermService;
use Scandinaver\Learning\Asset\UI\Command\AddTermAndTranslateCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class AddTermAndTranslateCommandHandler
 *
 * @package Scandinaver\Learning\Asset\Application\Handler\Command
 */
class AddTermAndTranslateCommandHandler extends AbstractHandler
{

    public function __construct(private TermService $service)
    {
        parent::__construct();
    }

    /**
     * @param  AddTermAndTranslateCommand  $command
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->create(
            config('app.lang'),
            $command->getWord(),
            $command->getIssentence(),
            $command->getTranslate()
        );

        $this->resource = new NullResource();
    }
} 
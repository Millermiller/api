<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\DeleteIntroCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteIntroCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteIntroCommandHandler extends AbstractHandler
{
    private IntroService $service;

    public function __construct(IntroService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeleteIntroCommand|CommandInterface  $command
     *
     * @throws IntroNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->delete($command->getId());

        $this->resource = new NullResource();
    }
} 
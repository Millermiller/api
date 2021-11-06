<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Command\DeleteIntroCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  DeleteIntroCommand|BaseCommandInterface  $command
     *
     * @throws IntroNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $this->service->delete($command->getId());

        $this->resource = new NullResource();
    }
} 
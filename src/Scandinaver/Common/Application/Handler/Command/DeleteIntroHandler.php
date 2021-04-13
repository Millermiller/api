<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Contract\Command\DeleteIntroHandlerInterface;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\DeleteIntroCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteIntroHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteIntroHandler extends AbstractHandler implements DeleteIntroHandlerInterface
{

    private IntroService $service;

    public function __construct(IntroService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeleteIntroCommand|Command  $command
     *
     * @throws IntroNotFoundException
     */
    public function handle($command): void
    {
        $this->service->delete($command->getId());

        $this->resource = new NullResource();
    }
} 
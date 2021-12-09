<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Command\DeleteIntroCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteIntroCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class DeleteIntroCommandHandler extends AbstractHandler
{

    public function __construct(private IntroService $service)
    {
        parent::__construct();

    }

    /**
     * @throws IntroNotFoundException
     */
    public function handle(CommandInterface|DeleteIntroCommand $command): void
    {
        $this->service->delete($command->getId());

        $this->resource = new NullResource();
    }
} 
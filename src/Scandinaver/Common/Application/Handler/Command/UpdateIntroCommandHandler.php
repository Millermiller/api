<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Services\IntroService;
use Scandinaver\Common\UI\Command\UpdateIntroCommand;
use Scandinaver\Common\UI\Resources\IntroTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateIntroCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateIntroCommandHandler extends AbstractHandler
{

    private IntroService $service;

    public function __construct(IntroService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  UpdateIntroCommand|CommandInterface  $command
     *
     * @throws IntroNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $intro = $this->service->update($command->getIntroId(), $command->getData());

        $this->resource = new Item($intro, new IntroTransformer());
    }
} 
<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Exception\IntroNotFoundException;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Command\UpdateIntroCommand;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateIntroCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateIntroCommandHandler extends AbstractHandler
{

    public function __construct(private IntroService $service)
    {
        parent::__construct();

    }

    /**
     * @throws IntroNotFoundException
     */
    public function handle(CommandInterface|UpdateIntroCommand $command): void
    {
        $intro = $this->service->update($command->getIntroId(), $command->buildDTO());

        $this->resource = new Item($intro, new IntroTransformer());
    }
} 
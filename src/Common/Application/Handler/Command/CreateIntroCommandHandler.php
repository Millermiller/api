<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Command\CreateIntroCommand;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateIntroCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateIntroCommandHandler extends AbstractHandler
{

    public function __construct(private IntroService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CreateIntroCommand  $command
     */
    public function handle(CommandInterface $command): void
    {
        $intro = $this->service->create($command->buildDTO());

        $this->resource = new Item($intro, new IntroTransformer());
    }
} 
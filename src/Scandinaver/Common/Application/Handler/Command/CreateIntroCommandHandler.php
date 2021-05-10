<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Command\CreateIntroCommand;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class CreateIntroCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateIntroCommandHandler extends AbstractHandler
{
    private IntroService $introService;

    public function __construct(IntroService $introService)
    {
        parent::__construct();

        $this->introService = $introService;
    }

    /**
     * @param  CreateIntroCommand|BaseCommandInterface  $command
     */
    public function handle(BaseCommandInterface $command): void
    {
        $intro = $this->introService->create($command->buildDTO());

        $this->resource = new Item($intro, new IntroTransformer());
    }
} 
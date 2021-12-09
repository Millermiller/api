<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Command\CreateLanguageCommand;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateLanguageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class CreateLanguageCommandHandler extends AbstractHandler
{

    public function __construct(private LanguageService $service)
    {
        parent::__construct();
    }

    public function handle(CommandInterface|CreateLanguageCommand $command): void
    {
        $language = $this->service->createLanguage($command->getData());

        $this->resource = new Item($language, new LanguageTransformer());
    }
} 
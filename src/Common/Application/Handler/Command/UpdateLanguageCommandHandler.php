<?php


namespace Scandinaver\Common\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Command\UpdateLanguageCommand;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateLanguageCommandHandler
 *
 * @package Scandinaver\Common\Application\Handler\Command
 */
class UpdateLanguageCommandHandler extends AbstractHandler
{

    public function __construct(private LanguageService $service)
    {
        parent::__construct();
    }

    /**
     * @param  UpdateLanguageCommand  $command
     */
    public function handle(CommandInterface $command): void
    {
        $language = $this->service->updateLanguage($command->getId(), $command->getData());

        $this->resource = new Item($language, new LanguageTransformer());
    }
} 
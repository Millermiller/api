<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Service\CategoryService;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeleteCategoryCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCategoryCommandHandler extends AbstractHandler
{

    public function __construct(private CategoryService $service)
    {
        parent::__construct();
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function handle(CommandInterface|DeleteCategoryCommand $command): void
    {
        $this->service->delete($command->getCategoryId());

        $this->resource = new NullResource();
    }
} 
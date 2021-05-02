<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Service\CategoryService;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteCategoryCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCategoryCommandHandler extends AbstractHandler
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeleteCategoryCommand|CommandInterface  $command
     *
     * @throws CategoryNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->delete($command->getCategoryId());

        $this->resource = new NullResource();
    }
} 
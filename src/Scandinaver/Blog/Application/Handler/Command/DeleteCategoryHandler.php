<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Blog\Domain\Contract\Command\DeleteCategoryHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCategoryHandler extends AbstractHandler implements DeleteCategoryHandlerInterface
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  DeleteCategoryCommand|Command  $command
     *
     * @throws CategoryNotFoundException
     */
    public function handle($command): void
    {
        $this->service->delete($command->getCategoryId());

        $this->resource = new NullResource();
    }
} 
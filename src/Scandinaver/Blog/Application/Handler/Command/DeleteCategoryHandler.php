<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\DeleteCategoryHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCategoryHandler implements DeleteCategoryHandlerInterface
{

    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
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
    }
} 
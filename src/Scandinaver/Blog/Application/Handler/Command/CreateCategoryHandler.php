<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\CreateCategoryHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CategoryDuplicateException;
use Scandinaver\Blog\Domain\Model\CategoryDTO;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Command\CreateCategoryCommand;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCategoryHandler implements CreateCategoryHandlerInterface
{

    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CreateCategoryCommand|Command  $command
     *
     * @return CategoryDTO
     * @throws CategoryDuplicateException
     */
    public function handle($command): CategoryDTO
    {
        return $this->service->create($command->getData());
    }
}
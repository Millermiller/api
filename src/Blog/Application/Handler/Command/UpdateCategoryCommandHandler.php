<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Service\CategoryService;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateCategoryCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class UpdateCategoryCommandHandler extends AbstractHandler
{

    public function __construct(private CategoryService $service)
    {
        parent::__construct();
    }

    /**
     * @param  UpdateCategoryCommand  $command
     *
     * @throws CategoryNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $category = $this->service->update($command->getCategoryId(), $command->buildDTO());

        $this->resource = new Item($category, new CategoryTransformer());
    }
} 
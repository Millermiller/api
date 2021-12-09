<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryDuplicateException;
use Scandinaver\Blog\Domain\Service\CategoryService;
use Scandinaver\Blog\UI\Command\CreateCategoryCommand;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateCategoryCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCategoryCommandHandler extends AbstractHandler
{

    public function __construct(private CategoryService $service)
    {
        parent::__construct();
    }

    /**
     * @throws CategoryDuplicateException
     */
    public function handle(CommandInterface|CreateCategoryCommand $command): void
    {
        $category = $this->service->create($command->buildDTO());

        $this->resource = new Item($category, new CategoryTransformer());
    }
}
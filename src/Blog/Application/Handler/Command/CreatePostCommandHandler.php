<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Command\CreatePostCommand;
use Scandinaver\Blog\UI\Resources\PostTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class CreatePostCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreatePostCommandHandler extends AbstractHandler
{

    public function __construct(private BlogService $service)
    {
        parent::__construct();
    }

    /**
     * @throws CategoryNotFoundException
     * @throws UserNotFoundException
     */
    public function handle(CommandInterface|CreatePostCommand $command): void
    {
        $post = $this->service->create($command->buildDTO());

        $this->fractal->parseIncludes('comments');

        $this->resource = new Item($post, new PostTransformer());
    }
} 
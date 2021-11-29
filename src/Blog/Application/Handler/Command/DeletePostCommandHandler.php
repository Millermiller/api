<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\NullResource;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Blog\Domain\Service\BlogService;
use Scandinaver\Blog\UI\Command\DeletePostCommand;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class DeletePostCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeletePostCommandHandler extends AbstractHandler
{

    public function __construct(private BlogService $service)
    {
        parent::__construct();
    }

    /**
     * @param  DeletePostCommand  $command
     *
     * @throws PostNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->service->deletePost($command->getPostId());

        $this->resource = new NullResource();
    }
} 
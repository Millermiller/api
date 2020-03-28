<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\DeleteCategoryCommand;

/**
 * Class DeleteCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handlers
 */
class DeleteCategoryHandler implements DeleteCategoryHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param DeleteCategoryCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\UpdateCategoryCommand;

/**
 * Class UpdateCategoryHandler
 * @package Scandinaver\Blog\Application\Handlers
 */
class UpdateCategoryHandler implements UpdateCategoryHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param UpdateCategoryCommand
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
<?php


namespace Scandinaver\Blog\Application\Handlers;

use Scandinaver\Blog\Application\Commands\CreateCategoryCommand;

/**
 * Class CreateCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handlers
 */
class CreateCategoryHandler implements CreateCategoryHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CreateCategoryCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
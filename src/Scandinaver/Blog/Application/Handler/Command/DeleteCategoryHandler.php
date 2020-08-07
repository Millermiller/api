<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\DeleteCategoryHandlerInterface;
use Scandinaver\Blog\UI\Command\DeleteCategoryCommand;

/**
 * Class DeleteCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class DeleteCategoryHandler implements DeleteCategoryHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  DeleteCategoryCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
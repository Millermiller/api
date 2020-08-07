<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\UpdateCategoryHandlerInterface;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;

/**
 * Class UpdateCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class UpdateCategoryHandler implements UpdateCategoryHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  UpdateCategoryCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
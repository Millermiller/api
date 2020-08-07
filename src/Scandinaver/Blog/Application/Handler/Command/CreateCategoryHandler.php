<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\CreateCategoryHandlerInterface;
use Scandinaver\Blog\UI\Command\CreateCategoryCommand;

/**
 * Class CreateCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCategoryHandler implements CreateCategoryHandlerInterface
{

    public function __construct()
    {

    }

    /**
     * @param  CreateCategoryCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
}
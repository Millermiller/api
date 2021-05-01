<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateSynonymCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\CreateSynonymCommandHandler
 */
class CreateSynonymCommand implements CommandInterface
{
    public function __construct(array $data)
    {
    }
}
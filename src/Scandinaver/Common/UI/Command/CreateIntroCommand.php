<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateIntroCommand
 *
 * @see     \Scandinaver\Common\Application\Handler\Command\CreateIntroCommandHandler
 *
 * @package Scandinaver\Common\UI\Command
 */
class CreateIntroCommand implements CommandInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function buildDTO(): IntroDTO
    {
        return IntroDTO::fromArray($this->data);
    }
}
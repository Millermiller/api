<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Application\Handler\Command\UpdateIntroCommandHandler;
use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateIntroCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
#[Command(UpdateIntroCommandHandler::class)]
class UpdateIntroCommand implements CommandInterface
{

    public function __construct(private int $introId, private array $data)
    {
    }

    public function getIntroId(): int
    {
        return $this->introId;
    }

    public function buildDTO(): IntroDTO
    {
        return IntroDTO::fromArray($this->data);
    }
}
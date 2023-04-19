<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Application\Handler\Command\CreateIntroCommandHandler;
use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateIntroCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
#[Handler(CreateIntroCommandHandler::class)]
class CreateIntroCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function buildDTO(): IntroDTO
    {
        return IntroDTO::fromArray($this->data);
    }
}
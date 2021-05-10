<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class UpdateIntroCommand
 *
 * @package Scandinaver\Common\UI\Command
 * @see     \Scandinaver\Common\Application\Handler\Command\UpdateIntroCommandHandler
 */
class UpdateIntroCommand implements CommandInterface
{

    private int $introId;
    private array $data;

    public function __construct(int $introId, array $data)
    {
        $this->introId = $introId;
        $this->data    = $data;
    }

    public function getIntroId(): int
    {
        return $this->introId;
    }

    public function buildDTO(): DTO
    {
        return IntroDTO::fromArray($this->data);
    }
}
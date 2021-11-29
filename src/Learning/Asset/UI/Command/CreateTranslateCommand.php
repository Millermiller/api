<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\CreateTranslateCommandHandler;

/**
 * Class CreateTranslateCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Command(CreateTranslateCommandHandler::class)]
class CreateTranslateCommand implements CommandInterface
{

    private int $card_id;

    private string $text;

    private string $value;

    public function __construct(int $card_id, array $data)
    {
        $this->card_id = $card_id;
        $this->text    = $data['text'];
        $this->value   = $data['value'];
    }

    public function getCard(): int
    {
        return $this->card_id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
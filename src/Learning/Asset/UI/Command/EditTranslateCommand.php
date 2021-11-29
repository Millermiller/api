<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\EditTranslateCommandHandler;

/**
 * Class EditTranslateCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Command(EditTranslateCommandHandler::class)]
class EditTranslateCommand implements CommandInterface
{

    private int $translateId;

    private int $cardId;

    private string $text;

    public function __construct(array $data)
    {
        $this->translateId = $data['id'];
        $this->cardId      = $data['card_id'];
        $this->text        = $data['text'];
    }

    public function getTranslate(): int
    {
        return $this->translateId;
    }

    public function getCard(): int
    {
        return $this->cardId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
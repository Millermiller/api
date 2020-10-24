<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateTranslateCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CreateTranslateHandler
 * @package Scandinaver\Learn\UI\Command
 */
class CreateTranslateCommand implements Command
{
    private int $card_id;

    private string $text;

    private string $value;

    private CardRepositoryInterface $cardRepository;

    public function __construct(int $card_id, array $data)
    {
        $this->card_id = $card_id;
        $this->text = $data['text'];
        $this->value = $data['value'];

        $this->cardRepository = app()->make('CardRepositoryInterface');
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
}
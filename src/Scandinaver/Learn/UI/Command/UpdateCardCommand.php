<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UpdateCardCommandHandler
 */
class UpdateCardCommand implements CommandInterface
{
    private int $card;

    private array $data;

    public function __construct(int $card, array $data)
    {
        $this->card = $card;
        $this->data = $data;
    }

    public function getCard(): int
    {
        return $this->card;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
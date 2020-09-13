<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see \Scandinaver\Learn\Application\Handler\Command\UpdateCardHandler
 */
class UpdateCardCommand implements Command
{

    private Card $card;

    private array $data;

    public function __construct(Card $card, array $data)
    {
        $this->card = $card;
        $this->data = $data;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
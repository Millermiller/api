<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class EditTranslateCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\EditTranslateCommandHandler
 * @package Scandinaver\Learn\UI\Command
 */
class EditTranslateCommand implements CommandInterface
{
    private int $translateId;

    private int $cardId;

    private string $text;

    private TranslateRepositoryInterface $translateRepository;

    private CardRepositoryInterface $cardRepository;

    public function __construct(array $data)
    {
        $this->translateId = $data['id'];
        $this->cardId      = $data['card_id'];
        $this->text        = $data['text'];

        $this->translateRepository = app()->make(
            'TranslateRepositoryInterface'
        );
        $this->cardRepository      = app()->make('CardRepositoryInterface');
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
}
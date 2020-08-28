<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Shared\Contract\Command;

/**
 * Class EditTranslateCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\EditTranslateHandler
 * @package Scandinaver\Learn\UI\Command
 */
class EditTranslateCommand implements Command
{
    private int $translate_id;

    private int $card_id;

    private string $text;

    private TranslateRepositoryInterface $translateRepository;

    private CardRepositoryInterface $cardRepository;

    public function __construct(array $data)
    {
        $this->translate_id = $data['id'];
        $this->card_id = $data['card_id'];
        $this->text = $data['text'];

        $this->translateRepository = app()->make(
            'TranslateRepositoryInterface'
        );
        $this->cardRepository = app()->make('CardRepositoryInterface');
    }

    public function getTranslate(): Translate
    {
        return $this->translateRepository->find($this->translate_id);
    }

    public function getCard(): Card
    {
        return $this->cardRepository->find($this->card_id);
    }

    public function getText(): string
    {
        return $this->text;
    }
}
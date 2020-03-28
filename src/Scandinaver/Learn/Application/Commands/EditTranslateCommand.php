<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Learn\Domain\Card;
use Scandinaver\Learn\Domain\Contracts\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contracts\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Translate;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class EditTranslateCommand
 * @package Scandinaver\Learn\Application\Commands
 *
 * @see \Scandinaver\Learn\Application\Handlers\EditTranslateHandler
 */
class EditTranslateCommand implements Command
{
    /**
     * @var int
     */
    private $translate_id;

    /**
     * @var int
     */
    private $card_id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var TranslateRepositoryInterface
     */
    private $translateRepository;

    /**
     * @var CardRepositoryInterface
     */
    private $cardRepository;

    public function __construct(array $data)
    {
        $this->translate_id = $data['id'];
        $this->card_id = $data['card_id'];
        $this->text = $data['text'];

        $this->translateRepository = app()->make('TranslateRepositoryInterface');
        $this->cardRepository = app()->make('CardRepositoryInterface');
    }

    /**
     * @return Translate
     */
    public function getTranslate(): object
    {
        return $this->translateRepository->find($this->translate_id);
    }

    /**
     * @return Card
     */
    public function getCard(): object
    {
        return $this->cardRepository->find($this->card_id);
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
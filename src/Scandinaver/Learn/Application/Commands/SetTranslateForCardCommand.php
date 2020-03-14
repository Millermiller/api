<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Learn\Domain\Card;
use Scandinaver\Learn\Domain\Contracts\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contracts\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contracts\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Translate;
use Scandinaver\Learn\Domain\Word;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class SetTranslateForCardCommand
 * @package Scandinaver\Learn\Application\Commands
 */
class SetTranslateForCardCommand implements Command
{
    /**
     * @var int
     */
    private $card_id;

    /**
     * @var int
     */
    private $word_id;

    /**
     * @var int
     */
    private $translate_id;

    /**
     * @var CardRepositoryInterface
     */
    private $cardRepository;

    /**
     * @var WordRepositoryInterface
     */
    private $wordRepository;

    /**
     * @var TranslateRepositoryInterface
     */
    private $translateRepository;

    /**
     * SetTranslateForCardCommand constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->card_id = $data['card_id'];
        $this->word_id = $data['word_id'];
        $this->translate_id = $data['translate_id'];

        $this->cardRepository = app()->make('CardRepositoryInterface');
        $this->wordRepository = app()->make('WordRepositoryInterface');
        $this->translateRepository = app()->make('TranslateRepositoryInterface');
    }

    /**
     * @return Card
     */
    public function getCard(): object
    {
        return $this->cardRepository->find($this->card_id);
    }

    /**
     * @return Word
     */
    public function getWord(): object
    {
        return $this->wordRepository->find($this->word_id);
    }

    /**
     * @return Translate
     */
    public function getTranslate(): object
    {
        return $this->translateRepository->find($this->translate_id);
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->getCard()->getAsset();
    }
}
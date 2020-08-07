<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Shared\Contract\Command;

/**
 * Class SetTranslateForCardCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\SetTranslateForCardCommandHandler
 * @package Scandinaver\Learn\UI\Command
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
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->card_id = $data['card_id'];
        $this->word_id = $data['word_id'];
        $this->translate_id = $data['translate_id'];

        $this->cardRepository = app()->make('CardRepositoryInterface');
        $this->wordRepository = app()->make('WordRepositoryInterface');
        $this->translateRepository = app()->make(
            'TranslateRepositoryInterface'
        );
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

    /**
     * @return Card
     */
    public function getCard(): object
    {
        return $this->cardRepository->find($this->card_id);
    }
}
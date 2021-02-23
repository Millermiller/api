<?php


namespace Scandinaver\Learn\UI\Command;

use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Shared\Contract\Command;

/**
 * Class SetTranslateForCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\SetTranslateForCardCommandHandler
 */
class SetTranslateForCardCommand implements Command
{
    private int $card_id;

    private int $word_id;

    private int $translate_id;

    private CardRepositoryInterface $cardRepository;

    private WordRepositoryInterface $wordRepository;

    private TranslateRepositoryInterface $translateRepository;

    /**
     * SetTranslateForCardCommand constructor.
     *
     * @param  array  $data
     *
     * @throws BindingResolutionException
     */
    public function __construct(array $data)
    {
        $this->card_id      = $data['card_id'];
        $this->word_id      = $data['word_id'];
        $this->translate_id = $data['translate_id'];

        $this->cardRepository      = app()->make('CardRepositoryInterface');
        $this->wordRepository      = app()->make('WordRepositoryInterface');
        $this->translateRepository = app()->make(
            'TranslateRepositoryInterface'
        );
    }

    public function getWord(): Word
    {
        return $this->wordRepository->find($this->word_id);
    }

    public function getTranslate(): Translate
    {
        return $this->translateRepository->find($this->translate_id);
    }

    public function getAsset(): Asset
    {
        return $this->getCard()->getAsset();
    }

    public function getCard(): Card
    {
        return $this->cardRepository->find($this->card_id);
    }
}
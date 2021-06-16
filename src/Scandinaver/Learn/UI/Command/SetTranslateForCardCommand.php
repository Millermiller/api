<?php


namespace Scandinaver\Learn\UI\Command;

use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Learn\Domain\Entity\Card;
use Scandinaver\Learn\Domain\Entity\Translate;
use Scandinaver\Learn\Domain\Entity\Term;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * //TODO: refactor
 * Class SetTranslateForCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\SetTranslateForCardCommandHandler
 */
class SetTranslateForCardCommand implements CommandInterface
{
    private int $card_id;

    private int $word_id;

    private int $translate_id;

    private CardRepositoryInterface $cardRepository;

    private TermRepositoryInterface $wordRepository;

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
        $this->wordRepository      = app()->make('TermRepositoryInterface');
        $this->translateRepository = app()->make(
            'TranslateRepositoryInterface'
        );
    }

    public function getWord(): Term
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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
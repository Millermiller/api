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

        $this->translateRepository = app()->make(
            'TranslateRepositoryInterface'
        );
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
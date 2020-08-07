<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateTranslateCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CreateTranslateHandler
 * @package Scandinaver\Learn\UI\Command
 */
class CreateTranslateCommand implements Command
{
    /**
     * @var int
     */
    private $card_id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $value;

    /**
     * @var CardRepositoryInterface
     */
    private $cardRepository;

    /**
     * CreateTranslateCommand constructor.
     *
     * @param  int    $card_id
     * @param  array  $data
     */
    public function __construct(int $card_id, array $data)
    {
        $this->card_id = $card_id;
        $this->text = $data['text'];
        $this->value = $data['value'];

        $this->cardRepository = app()->make('CardRepositoryInterface');
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

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
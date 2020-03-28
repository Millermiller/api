<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Learn\Domain\Card;
use Scandinaver\Learn\Domain\Contracts\CardRepositoryInterface;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class CreateTranslateCommand
 *
 * @package Scandinaver\Learn\Application\Commands
 * @see     \Scandinaver\Learn\Application\Handlers\CreateTranslateHandler
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
     * @param int   $card_id
     * @param array $data
     */
    public function __construct(int $card_id, array $data)
    {
        $this->card_id = $card_id;
        $this->text    = $data['text'];
        $this->value   = $data['value'];

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
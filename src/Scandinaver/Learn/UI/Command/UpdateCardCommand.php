<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\DTO\CardDTO;
use Scandinaver\Learn\Domain\DTO\TranslateDTO;
use Scandinaver\Learn\Domain\DTO\WordDTO;
use Scandinaver\Learn\Domain\Model\ExampleDTO;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class UpdateCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UpdateCardCommandHandler
 */
class UpdateCardCommand implements CommandInterface
{
    private int $cardId;

    private array $data;

    public function __construct(int $cardId, array $data)
    {
        $this->cardId = $cardId;
        $this->data = $data;
    }

    public function getCardId(): int
    {
        return $this->cardId;
    }

    public function buildDTO(): DTO
    {
        $cardDTO = new CardDTO();

        $examplesDTO = [];

        $examples = $this->data['examples'];
        foreach ($examples as $example) {
            $examplesDTO[] = ExampleDTO::fromArray($example);
        }

        $cardDTO->setExamplesDTO($examplesDTO);
        $cardDTO->setWordDTO(WordDTO::fromArray($this->data['word']));
        $cardDTO->setTranslateDTO(TranslateDTO::fromArray($this->data['translate']));
        $cardDTO->setId($this->data['id']);

        return $cardDTO;
    }
}
<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Learning\Asset\Domain\DTO\CardDTO;
use Scandinaver\Learning\Asset\Domain\DTO\TranslateDTO;
use Scandinaver\Learning\Asset\Domain\DTO\TermDTO;
use Scandinaver\Learning\Asset\Domain\Entity\ExampleDTO;
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
        $cardDTO->setTermDTO(TermDTO::fromArray($this->data['word']));
        $cardDTO->setTranslateDTO(TranslateDTO::fromArray($this->data['translate']));
        $cardDTO->setId($this->data['id']);

        return $cardDTO;
    }
}
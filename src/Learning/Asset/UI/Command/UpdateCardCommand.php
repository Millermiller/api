<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\UpdateCardCommandHandler;
use Scandinaver\Learning\Asset\Domain\DTO\CardDTO;
use Scandinaver\Learning\Asset\Domain\DTO\TermDTO;
use Scandinaver\Learning\Asset\Domain\DTO\TranslateDTO;
use Scandinaver\Learning\Asset\Domain\Entity\ExampleDTO;

/**
 * Class UpdateCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Command(UpdateCardCommandHandler::class)]
class UpdateCardCommand implements CommandInterface
{

    public function __construct(private int $cardId, private array $data)
    {
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
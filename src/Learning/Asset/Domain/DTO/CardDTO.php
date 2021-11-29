<?php


namespace Scandinaver\Learning\Asset\Domain\DTO;

use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\ExampleDTO;
use Scandinaver\Core\Domain\DTO;

/**
 * Class CardDTO
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class CardDTO extends DTO
{
    private ?int $id;

    private ?UserInterface $creator;

    private Language $language;

    private TermDTO $termDTO;

    private TranslateDTO $translateDTO;

    /** @var ExampleDTO[] $examplesDTO*/
    private array $examplesDTO;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCreator(): ?UserInterface
    {
        return $this->creator;
    }

    public function setCreator(?UserInterface $creator): void
    {
        $this->creator = $creator;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function getTranslateDTO(): TranslateDTO
    {
        return $this->translateDTO;
    }

    public function getTermDTO(): TermDTO
    {
        return $this->termDTO;
    }

    public function setTermDTO(TermDTO $termDTO): void
    {
        $this->termDTO = $termDTO;
    }

    public function setTranslateDTO(TranslateDTO $translateDTO): void
    {
        $this->translateDTO = $translateDTO;
    }

    public function getExamplesDTO(): array
    {
        return $this->examplesDTO;
    }

    public function setExamplesDTO(array $examplesDTO): void
    {
        $this->examplesDTO = $examplesDTO;
    }

    public static function fromArray(array $data): CardDTO
    {
        return new self();
    }
}
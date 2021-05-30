<?php


namespace Scandinaver\Learn\Domain\DTO;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Example;
use Scandinaver\Learn\Domain\Model\ExampleDTO;
use Scandinaver\Shared\DTO;

/**
 * Class CardDTO
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class CardDTO extends DTO
{
    private ?int $id;

    private ?UserInterface $creator;

    private Language $language;

    private WordDTO $wordDTO;

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

    public function getWordDTO(): WordDTO
    {
        return $this->wordDTO;
    }

    public function setWordDTO(WordDTO $wordDTO): void
    {
        $this->wordDTO = $wordDTO;
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
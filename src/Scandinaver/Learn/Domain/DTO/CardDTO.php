<?php


namespace Scandinaver\Learn\Domain\DTO;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Example;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CardDTO
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class CardDTO extends DTO
{
    private ?int $id;

    private ?User $creator;

    private Language $language;

    private WordDTO $wordDTO;

    private TranslateDTO $translateDTO;

    /** @var Example[] $examples*/
    private array $examples;

    private bool $favourite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): void
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

    public function isFavourite(): bool
    {
        return $this->favourite;
    }

    public function setFavourite(bool $favourite): void
    {
        $this->favourite = $favourite;
    }

    public function getExamples(): array
    {
        return $this->examples;
    }

    public function setExamples(array $examples): void
    {
        $this->examples = $examples;
    }
}
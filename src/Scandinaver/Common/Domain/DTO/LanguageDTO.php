<?php


namespace Scandinaver\Common\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class LanguageDTO
 *
 * @package Scandinaver\Common\Domain\Entity
 */
class LanguageDTO extends DTO
{
    private ?int $id;

    private string $title;

    private string $label;

    private string $letter;

    private string $flag;

    private int $assetsAvailable;

    private int $assetsAll;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getLetter(): string
    {
        return $this->letter;
    }

    public function setLetter(string $letter): void
    {
        $this->letter = $letter;
    }

    public function getFlag(): string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): void
    {
        $this->flag = $flag;
    }

    public function getAssetsAvailable(): int
    {
        return $this->assetsAvailable;
    }

    public function setAssetsAvailable(int $assetsAvailable): void
    {
        $this->assetsAvailable = $assetsAvailable;
    }

    public function getAssetsAll(): int
    {
        return $this->assetsAll;
    }

    public function setAssetsAll(int $assetsAll): void
    {
        $this->assetsAll = $assetsAll;
    }

    public static function fromArray(array $data): LanguageDTO
    {
        $languageDTO = new self();

        $languageDTO->setId($data['id'] ?? NULL);
        $languageDTO->setLetter($data['letter']);
        $languageDTO->setTitle($data['title']);

        return $languageDTO;
    }
}
<?php


namespace Scandinaver\Learning\Translate\Domain\DTO;


use Scandinaver\Core\Domain\DTO;

/**
 * Class DictionaryItemDTO
 *
 * @package Scandinaver\Translate\Domain\DTO
 */
class DictionaryItemDTO extends DTO
{
    private ?int $id;

    private string $text;

    private string $value;

    private int $sentenceNumber;

    private array $coordinates;

    /** @var SynonymDTO[] $synonyms */
    private array $synonyms;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getSynonyms(): array
    {
        return $this->synonyms;
    }

    public function setSynonyms(array $synonyms): void
    {
        $this->synonyms = $synonyms;
    }

    public function getSentenceNumber(): int
    {
        return $this->sentenceNumber;
    }

    public function setSentenceNumber(int $sentenceNumber): void
    {
        $this->sentenceNumber = $sentenceNumber;
    }

    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    public static function fromArray(array $data): DictionaryItemDTO
    {
        $dictionaryDTO = new self();

        $dictionaryDTO->setId($data['id'] ?? NULL);
        $dictionaryDTO->setText($data['text']);
        $dictionaryDTO->setValue($data['value']);
        $dictionaryDTO->setSentenceNumber($data['sentenceNum']);
        $dictionaryDTO->setCoordinates($data['coordinates']);

        $synonyms = [];

        foreach ($data['synonyms'] as $synonymData) {
            $synonyms[] = SynonymDTO::fromArray($synonymData);
        }

        $dictionaryDTO->setSynonyms($synonyms);

        return $dictionaryDTO;
    }
}
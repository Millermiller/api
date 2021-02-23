<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use JsonSerializable;
use Scandinaver\Common\Domain\Model\Language;

/**
 * Class Translate
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Translate implements JsonSerializable
{
    private $id;

    private string $value;

    private int $sentence;

    private Word $word;

    private Language $language;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'       => $this->id,
            'value'    => $this->value,
            'word_id'  => $this->word->getId(),
            'word'     => $this->word,
            'sentence' => $this->sentence,
            'active'   => $this->id,
        ];
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setSentence(int $sentence): void
    {
        $this->sentence = $sentence;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function getSentence(): int
    {
        return $this->sentence;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}

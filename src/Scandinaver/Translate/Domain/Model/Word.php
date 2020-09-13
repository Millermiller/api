<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Class Word
 *
 * @package Scandinaver\Translate\Domain\Model
 */
class Word implements JsonSerializable
{
    private int $id;

    private int $sentenceNum;

    private string $word;

    private string $orig;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Text $text;

    private Collection $synonyms;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'text_id' => $this->text->getId(),
            'sentence_num' => $this->sentenceNum,
            'word' => $this->word,
            'orig' => $this->orig,
        ];
    }
}

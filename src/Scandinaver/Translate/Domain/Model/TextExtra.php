<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Class TextExtra
 *
 * @package Scandinaver\Translate\Domain\Model
 */
class TextExtra implements JsonSerializable
{
    private int $id;

    private string $orig;

    private string $extra;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Text $text;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'orig' => $this->orig,
            'extra' => $this->extra,
        ];
    }
}

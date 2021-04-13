<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;

/**
 * Class Word
 *
 * @package Scandinaver\Translate\Domain\Model
 */
class Word
{
    private int $id;

    private int $sentenceNum;

    private string $word;

    private string $orig;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Text $text;

    private Collection $synonyms;
}

<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;

/**
 * Class TextExtra
 *
 * @package Scandinaver\Translate\Domain\Model
 */
class TextExtra
{
    private int $id;

    private string $orig;

    private string $extra;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Text $text;
}

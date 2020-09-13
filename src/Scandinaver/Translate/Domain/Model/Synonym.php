<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;

/**
 * Class Synonym
 *
 * @package Scandinaver\Translate\Domain\Model
 */
class Synonym
{
    private int $id;

    private string $synonym;

    private Word $word;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;
}

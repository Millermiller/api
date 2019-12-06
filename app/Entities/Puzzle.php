<?php

namespace  App\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Puzzles
 *
 * @ORM\Table(name="puzzles")
 * @ORM\Entity
 */
class Puzzle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var string|null
     *
     * @ORM\Column(name="translate", type="string", length=255, nullable=true)
     */
    private $translate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language_id", type="string", length=10, nullable=true)
     */
    private $languageId;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
}

<?php


namespace Scandinaver\Translate\Domain;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Synonym
 * @ORM\Table(name="synonym", indexes={@ORM\Index(name="word_id", columns={"word_id", "synonym"})})
 *
 * @ORM\Entity
 */
class Synonym
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="word_id", type="integer", nullable=false)
     */
    private $wordId;

    /**
     * @var string
     * @ORM\Column(name="synonym", type="string", length=255, nullable=false)
     */
    private $synonym;

    /**
     * @var DateTime|null
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


}

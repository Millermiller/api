<?php


namespace Scandinaver\Translate\Domain\Model;

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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="synonym", type="string", length=255, nullable=false)
     */
    private string $synonym;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;
}

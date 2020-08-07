<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Categories
 * @ORM\Table(name="category", indexes={@ORM\Index(name="name",
 *   columns={"name"})})
 *
 * @ORM\Entity
 */
class Category implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private ?DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private ?DateTime $deletedAt;

    /**
     * @var Collection|Post[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Blog\Domain\Model\Post", mappedBy="category")
     */
    private $posts;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}

<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Scandinaver\User\Domain\Model\User;

/**
 * Comments
 * @ORM\Table(name="comment")
 *
 * @ORM\Entity
 */
class Comment implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="post_id", type="integer", nullable=true)
     */
    private ?int $postId;

    /**
     * @ORM\Column(name="text", type="text", length=65535, nullable=true)
     */
    private ?string $text;

    /**
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private ?int $userId;

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
     * @ORM\ManyToOne(targetEntity="Scandinaver\Blog\Domain\Model\Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private Post $post;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\User\Domain\Model\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $user;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'text' => $this->text,
            'asc' => 'asc',
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
}

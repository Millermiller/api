<?php


namespace Scandinaver\Blog\Domain;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Scandinaver\User\Domain\User;

/**
 * Comments
 * @ORM\Table(name="comments")
 *
 * @ORM\Entity
 */
class Comment implements JsonSerializable
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     * @ORM\Column(name="post_id", type="integer", nullable=true)
     */
    private $postId = '0';

    /**
     * @var string|null
     * @ORM\Column(name="text", type="text", length=65535, nullable=true)
     */
    private $text;

    /**
     * @var int|null
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId = '0';

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

    /**
     * @var DateTime|null
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="Scandinaver\Blog\Domain\Post", inversedBy="comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Scandinaver\User\Domain\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id'   => $this->getId(),
            'text' => $this->text,
            'asc'  => 'asc',
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}

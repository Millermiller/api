<?php

namespace  App\Entities;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Posts
 *
 * @ORM\Table(name="posts", indexes={@ORM\Index(name="post_name", columns={"title"}), @ORM\Index(name="post_author", columns={"user_id"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Post implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    private $title = '';

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $userId = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=true)
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="anonse", type="text", length=65535, nullable=true)
     */
    private $anonse;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="comment_status", type="integer", nullable=false, options={"default"="1"})
     */
    private $commentStatus = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="views", type="bigint", nullable=false)
     */
    private $views = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Collection|Comment[]
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     *
     */
    private $comments;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @return Comment[]|Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment[]|Collection $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user' => $this->user,
            'views' => $this->views,
            'category' => $this->category,
            'comments' => $this->comments->toArray(),
            'status' => $this->status,
            'comment_status' => $this->commentStatus,
            'created_at' => $this->getCreatedAt()->format("Y-m-d H:i:s")
        ];
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
}

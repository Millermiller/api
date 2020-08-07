<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * Posts
 * @ORM\Table(name="post", indexes={
 *     @ORM\Index(name="post_name", columns={"title"}),
 *     @ORM\Index(name="post_author", columns={"user_id"}),
 *     @ORM\Index(name="id", columns={"id"})
 * })
 *
 * @ORM\Entity
 */
class Post implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="bigint", nullable=false,
     *   options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    private string $title;

    /**
     * @ORM\Column(name="content", type="text", length=0, nullable=true)
     */
    private ?string $content;

    /**
     * @ORM\Column(name="anonse", type="text", length=65535, nullable=true)
     */
    private ?string $anonse;

    /**
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"default"="1"})
     */
    private bool $status;

    /**
     * @ORM\Column(name="comment_status", type="integer", nullable=false, options={"default"="1"})
     */
    private int $commentStatus;

    /**
     * @ORM\Column(name="views", type="bigint", nullable=false)
     */
    private int $views;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private ?DateTime $createdAt;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private ?DateTime $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="Scandinaver\Blog\Domain\Model\Comment", mappedBy="post")
     */
    private Collection $comments;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\User\Domain\Model\User", inversedBy="posts")
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Blog\Domain\Model\Category", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private Category $category;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Model\Language", inversedBy="posts")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private Language $language;

    /**
     * @return Comment[]|Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param  Comment[]|Collection  $comments
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
            'created_at' => $this->getCreatedAt()->format("Y-m-d H:i:s"),
        ];
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}

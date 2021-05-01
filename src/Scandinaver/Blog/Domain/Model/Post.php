<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Post
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class Post extends AggregateRoot
{
    private ?int $id;

    private string $title;

    private ?string $content;

    private ?string $anonse;

    private int $status;

    private int $commentStatus;

    private int $views;

    private ?DateTime $updatedAt;

    private DateTime $createdAt;

    private Collection $comments;

    private UserInterface $user;

    private Category $category;

    private Language $language;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function setComments(Collection $comments): void
    {
        $this->comments = $comments;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): void
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getCommentStatus(): int
    {
        return $this->commentStatus;
    }

    public function addComment(Comment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            // $this->pullEvents(new CommentAdded($this, $comment));
        }
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setCommentStatus(int $commentStatus): void
    {
        $this->commentStatus = $commentStatus;
    }

    public function setViews(int $views): void
    {
        $this->views = $views;
    }

    public function delete()
    {
        //  $this->pushEvent(PostDeleted());
    }

    public function getAnonse(): ?string
    {
        return $this->anonse;
    }

    public function setAnonse(?string $anonse): void
    {
        $this->anonse = $anonse;
    }
}

<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use JsonSerializable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Post
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class Post extends AggregateRoot
{
    private int $id;

    private string $title;

    private ?string $content;

    private ?string $anonse;

    private int $status;

    private int $commentStatus;

    private int $views;

    private ?DateTime $updatedAt;

    private DateTime $createdAt;

    private Collection $comments;

    private User $user;

    private Category $category;

    private Language $language;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function toDTO(): PostDTO
    {
        return new PostDTO($this);
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
}

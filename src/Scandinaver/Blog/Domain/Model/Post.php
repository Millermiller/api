<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use JsonSerializable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Post
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class Post implements JsonSerializable
{
    private int $id;

    private string $title;

    private ?string $content;

    private ?string $anonse;

    private bool $status;

    private int $commentStatus;

    private int $views;

    private ?DateTime $updatedAt;

    private DateTime $createdAt;

    private Collection $comments;

    private User $user;

    private Category $category;

    private Language $language;

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param  Comment[] $comments
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

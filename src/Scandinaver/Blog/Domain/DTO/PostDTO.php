<?php


namespace Scandinaver\Blog\Domain\DTO;

use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PostDTO
 *
 * @package Scandinaver\Blog\Domain\DTO
 */
class PostDTO extends DTO
{
    private ?int $id;

    private string $title;

    private Category $category;

    private int $status;

    private string $content;

    private string $anonce;

    private User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }


    public function getAnonce(): string
    {
        return $this->anonce;
    }

    public function setAnonce(string $anonce): void
    {
        $this->anonce = $anonce;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
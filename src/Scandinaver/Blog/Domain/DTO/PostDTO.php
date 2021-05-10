<?php


namespace Scandinaver\Blog\Domain\DTO;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\DTO;

/**
 * Class PostDTO
 *
 * @package Scandinaver\Blog\Domain\DTO
 */
class PostDTO extends DTO
{

    private ?int $id;

    private string $title;

    private int $categoryId;

    private int $status;

    private string $content;

    private string $anonce;

    private int $userId;

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

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public static function fromArray(array $data): PostDTO
    {
        $postDTO = new self();
        $postDTO->setId($data['id'] ?? NULL);
        $postDTO->setTitle($data['title']);
        $postDTO->setCategoryId($data['category']);
        $postDTO->setStatus($data['status'] ?? 0);
        $postDTO->setContent($data['content']);
        $postDTO->setAnonce($data['anonce'] ?? '');
        $postDTO->setUserId($data['userId']);

        return $postDTO;
    }
}
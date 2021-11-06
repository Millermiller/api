<?php


namespace Scandinaver\Blog\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class CommentDTO
 *
 * @package Scandinaver\Blog\Domain\DTO
 */
class CommentDTO extends DTO
{
    private int $postId;

    private string $text;

    private int $userId;

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public static function fromArray(array $data): CommentDTO
    {
        $commentDTO = new self();

        $commentDTO->setText($data['text']);
        $commentDTO->setUserId($data['userId']);

        if (isset($data['post_id'])) {
            $commentDTO->setPostId($data['post_id']);
        }

        return $commentDTO;
    }

}
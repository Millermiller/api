<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use JsonSerializable;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Comment
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class Comment implements JsonSerializable
{
    private int $id;

    private ?int $postId;

    private ?string $text;

    private int $userId;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Post $post;

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

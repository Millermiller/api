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
class Comment
{
    private int $id;

    private ?string $text;

    private Post $post;

    private User $user;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}

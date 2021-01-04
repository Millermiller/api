<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Comment
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class Comment extends AggregateRoot
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

    public function toDTO(): CommentDTO
    {
        return new CommentDTO($this);
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function setPost(Post $post): void
    {
        $post->addComment($this);
        $this->post = $post;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}

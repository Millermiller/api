<?php


namespace Scandinaver\Blog\Domain\Entity;

use DateTime;
use Scandinaver\Blog\Domain\Event\CommentAdded;
use Scandinaver\Blog\Domain\Event\CommentDeleted;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\AggregateRoot;

/**
 * Class Comment
 *
 * @package Scandinaver\Blog\Domain\Entity
 */
class Comment extends AggregateRoot
{

    private int $id;

    private ?string $text;

    private Post $post;

    private UserInterface $user;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function __construct()
    {
        $this->pushEvent(new CommentAdded($this));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }

    public function onDelete()
    {
        $this->pushEvent(new CommentDeleted($this));
    }

    public function setPost(Post $post): void
    {
        $post->addComment($this);
        $this->post = $post;
    }
}

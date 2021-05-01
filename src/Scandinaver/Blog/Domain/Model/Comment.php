<?php


namespace Scandinaver\Blog\Domain\Model;

use DateTime;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\AggregateRoot;

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

    private UserInterface $user;

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

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function setPost(Post $post): void
    {
        $post->addComment($this);
        $this->post = $post;
    }
}

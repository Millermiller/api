<?php


namespace Scandinaver\Blog\Domain\Model;


use Scandinaver\Shared\DTO;

class CommentDTO extends DTO
{
    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->comment->getId(),
            'text' => $this->comment->getText(),
            'user' => $this->comment->getUser(),
        ];
    }
}
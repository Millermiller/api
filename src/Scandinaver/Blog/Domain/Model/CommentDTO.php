<?php


namespace Scandinaver\Blog\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class CommentDTO
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class CommentDTO extends DTO
{
    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'   => $this->comment->getId(),
            'text' => $this->comment->getText(),
            'user' => $this->comment->getUser()->toDTO(),
        ];
    }
}
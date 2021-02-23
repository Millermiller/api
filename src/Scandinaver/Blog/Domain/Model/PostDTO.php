<?php


namespace Scandinaver\Blog\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class PostDTO
 *
 * @package Scandinaver\Blog\Domain\Model
 */
class PostDTO extends DTO
{

    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'             => $this->post->getId(),
            'title'          => $this->post->getTitle(),
            'content'        => $this->post->getContent(),
            'user'           => $this->post->getUser()->toDTO(),
            'views'          => $this->post->getViews(),
            'category'       => $this->post->getCategory()->toDTO(),
            'comments'       => $this->post->getComments()->map(fn($comment) => [
                'id'   => $comment->getId(),
                'text' => $comment->getText(),
                'user' => $comment->getUser()->toDTO(),
            ])->toArray(),
            'status'         => $this->post->getStatus(),
            'comment_status' => $this->post->getCommentStatus(),
            'created_at'     => $this->post->getCreatedAt()->format("Y-m-d H:i:s"),
        ];
    }
}
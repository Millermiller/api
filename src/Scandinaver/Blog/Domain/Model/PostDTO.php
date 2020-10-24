<?php


namespace Scandinaver\Blog\Domain\Model;


use Scandinaver\Shared\DTO;

class PostDTO extends DTO
{

    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->post->getId(),
            'title' => $this->post->getTitle(),
            'content' => $this->post->getContent(),
            'user' => $this->post->getUser(),
            'views' => $this->post->getViews(),
            'category' => $this->post->getCategory()->toDTO(),
            'comments' => $this->post->getComments()->map(
                fn($comment) => [
                    'id' => $comment->getId(),
                    'text' => $comment->getText(),
                    'user' => $comment->getUser(),
                ]
            )->toArray(),
            'status' => $this->post->getStatus(),
            'comment_status' => $this->post->getCommentStatus(),
            'created_at' => $this->post->getCreatedAt()->format("Y-m-d H:i:s"),
        ];
    }
}
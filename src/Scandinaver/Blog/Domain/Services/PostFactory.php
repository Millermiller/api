<?php


namespace Scandinaver\Blog\Domain\Services;

use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Blog\Domain\Model\Post;

/**
 * Class PostFactory
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class PostFactory
{
    public static function fromDTO(PostDTO $postDTO): Post
    {
        $post = new Post();

        $post->setTitle($postDTO->getTitle());
        $post->setCategory($postDTO->getCategory());
        $post->setContent($postDTO->getContent());
        $post->setAnonse($postDTO->getAnonce());
        $post->setUser($postDTO->getUser());
        $post->setStatus($postDTO->getStatus());
        $post->setCommentStatus(1);
        $post->setViews(0);

        return $post;
    }

    public static function toDTO(Post $post): PostDTO
    {
        $postDTO = new PostDTO();
        $postDTO->setId($post->getId());
        $postDTO->setTitle($post->getTitle());
        $postDTO->setCategory($post->getCategory());
        $postDTO->setContent($post->getContent());
        $postDTO->setAnonce($post->getAnonse());
        $postDTO->setUser($post->getUser());
        $postDTO->setStatus($post->getStatus());

        return $postDTO;
    }
}
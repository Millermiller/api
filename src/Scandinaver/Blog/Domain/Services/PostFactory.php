<?php


namespace Scandinaver\Blog\Domain\Services;


use Scandinaver\Blog\Domain\Model\Post;

class PostFactory
{
    public static function build(array $data): Post
    {
        $post = new Post();

        $post->setUser($data['user']);
        $post->setTitle($data['title']);
        $post->setCategory($data['category']);
        $post->setContent($data['content']);

        return $post;
    }
}
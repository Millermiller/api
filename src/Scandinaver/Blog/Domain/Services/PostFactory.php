<?php


namespace Scandinaver\Blog\Domain\Services;


use App\Helpers\Auth;
use Scandinaver\Blog\Domain\Model\Post;

class PostFactory
{
    public static function build(array $data): Post
    {
        $post = new Post();

        $post->setTitle($data['title']);
        $post->setCategory($data['category']);
        $post->setContent($data['content']);
        $post->setAnonse($data['anonse'] ?? null);
        $post->setUser(Auth::user());
        $post->setStatus($data['status']);
        $post->setCommentStatus(1);
        $post->setViews(0);

        return $post;
    }
}
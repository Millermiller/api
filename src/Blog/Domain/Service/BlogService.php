<?php


namespace Scandinaver\Blog\Domain\Service;

use Doctrine\ORM\Query\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JetBrains\PhpStorm\ArrayShape;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\DTO\PostDTO;
use Scandinaver\Blog\Domain\Entity\Post;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Exception\PostNotFoundException;
use Scandinaver\Core\Domain\Contract\BaseServiceInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\User\Domain\Exception\UserNotFoundException;

/**
 * Class BlogService
 *
 * @package Scandinaver\Blog\Domain\Services
 */
class BlogService implements BaseServiceInterface
{

    public function __construct(
        private PostRepositoryInterface $postRepository,
        private PostFactory $postFactory
    ) {
    }

    /**
     * @param  RequestParametersComposition  $params
     *
     * @return LengthAwarePaginator
     * @throws QueryException
     */
    public function all(RequestParametersComposition $params): LengthAwarePaginator
    {
        return $this->postRepository->getData($params);
    }

    /**
     * @param  int  $id
     *
     * @return Post
     * @throws PostNotFoundException
     */
    public function one(int $id): Post
    {
        return $this->getPost($id);
    }

    /**
     * @param  int  $id
     *
     * @return Post
     * @throws PostNotFoundException
     */
    private function getPost(int $id): Post
    {
        $post = $this->postRepository->find($id);
        if ($post === NULL) {
            throw new PostNotFoundException();
        }

        return $post;
    }

    /**
     * @param  PostDTO  $postDTO
     *
     * @return Post
     * @throws CategoryNotFoundException
     * @throws UserNotFoundException
     */
    public function create(PostDTO $postDTO): Post
    {
        $post = $this->postFactory->fromDTO($postDTO);

        $this->postRepository->save($post);

        return $post;
    }

    /**
     * @param  int      $post
     * @param  PostDTO  $postDTO
     *
     * @return Post
     * @throws CategoryNotFoundException
     * @throws PostNotFoundException
     * @throws UserNotFoundException
     */
    public function updatePost(int $post, PostDTO $postDTO): Post
    {
        $post = $this->getPost($post);

        $post = $this->postFactory->update($post, $postDTO);

        $this->postRepository->save($post);

        return $post;
    }

    /**
     * @param  int  $post
     *
     * @throws PostNotFoundException
     */
    public function deletePost(int $post)
    {
        $post = $this->getPost($post);
        $this->postRepository->delete($post);
    }

}
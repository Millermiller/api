<?php


namespace App\Repositories;

use App\Entities\Word;
use Doctrine\ORM\EntityManager;

class WordRepository
{
    /**
     * @var string
     */
    private $class = 'App\Entity\Post';
    /**
     * @var EntityManager
     */
    private $em;


    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @param Word $post
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Word $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * @param Word $post
     * @param $data
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Word $post, $data)
    {
        $post->setWord($data['title']);
        $this->em->persist($post);
        $this->em->flush();
    }

    public function PostOfId($id)
    {
        return $this->em->getRepository($this->class)->findOneBy([
            'id' => $id
        ]);
    }

    /**
     * @param Word $word
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Word $word)
    {
        $this->em->remove($word);
        $this->em->flush();
    }

    /**
     * create Post
     * @return Word
     */
    private function perpareData($data)
    {
        return new Word($data);
    }
}
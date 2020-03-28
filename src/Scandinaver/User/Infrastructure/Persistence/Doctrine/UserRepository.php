<?php


namespace Scandinaver\User\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{NonUniqueResultException, NoResultException, OptimisticLockException, ORMException};
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Text\Domain\Text;
use Scandinaver\User\Domain\{Plan, User};
use Scandinaver\User\Domain\Contracts\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * @package App\Repositories\User
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @return array|mixed
     */
    public function all(): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('u', 'p')
                 ->from($this::getEntityName(), 'u')
                 ->join('u.plan', 'p', 'WITH')
                 ->orderBy('p.id', 'asc')
                 ->getQuery()
                 ->getResult();
    }

    /**
     * @param $id
     *
     * @return object|void|null
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function get($id)
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('u', 'p')
                 ->from($this::getEntityName(), 'u')
                 ->join('u.plan', 'p', 'WITH')
                 ->where('u.id = :id')
                 ->setParameter('id', $id)
                 ->orderBy('p.id', 'asc')
                 ->getQuery()
                 ->getSingleResult();
    }

    /**
     * @param User  $user
     * @param Asset $asset
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addAsset(User $user, Asset $asset): void
    {
        $user->getAssets()->add($asset);
        //   $asset->getUsers()->add($user);


        $this->_em->flush();
    }

    /**
     * @param User $user
     * @param Text $text
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addText(User $user, Text $text): void
    {
        $user->getTexts()->add($text);
        $text->getUsers()->add($user);

        $this->_em->flush();
    }

    /**
     * @param User $user
     * @param Plan $plan
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function setPlan(User $user, Plan $plan): void
    {
        $user->setPlan($plan);
        $this->_em->flush();
    }

    /**
     * @param User   $user
     * @param string $file
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function setAvatar(User $user, string $file)
    {
        $user->setPhoto($file);
        $this->_em->flush();
    }

    /**
     * @param $string
     *
     * @return array
     */
    public function findByNameOrEmail($string): array
    {
        $q = $this->_em->createQueryBuilder();

        return $q->select('u', 'p')
                 ->from($this::getEntityName(), 'u')
                 ->join('u.plan', 'p', 'WITH')
                 ->where('u.login = :login')
                 ->orWhere('u.email = :email')
                 ->orderBy('u.id', 'desc')
                 ->setParameter('login', $string)
                 ->setParameter('email', $string)
                 ->getQuery()
                 ->getResult();
    }
}
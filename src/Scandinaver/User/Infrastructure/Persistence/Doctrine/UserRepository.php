<?php


namespace Scandinaver\User\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\{OptimisticLockException, ORMException};
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\User\Domain\Model\{Plan, User};
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * @package Scandinaver\User\Infrastructure\Persistence\Doctrine
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
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
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function setPlan(User $user, Plan $plan): void
    {
        $user->setPlan($plan);
        $this->_em->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function setAvatar(User $user, string $file)
    {
        $user->setPhoto($file);
        $this->_em->flush();
    }

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
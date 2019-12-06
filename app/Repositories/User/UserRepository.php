<?php


namespace App\Repositories\User;

use App\Entities\{Asset, Plan, Text, User};
use App\Repositories\BaseRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     * @param Asset $asset
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addAsset(User $user, Asset $asset) : void
    {
        $user->getAssets()->add($asset);
     //   $asset->getUsers()->add($user);


        $this->_em->flush();
    }

    /**
     * @param User $user
     * @param Text $text
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function addText(User $user, Text $text) : void
    {
        $user->getTexts()->add($text);
        $text->getUsers()->add($user);

        $this->_em->flush();
    }

    /**
     * @param User $user
     * @param Plan $plan
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function setPlan(User $user, Plan $plan): void
    {
        $user->setPlan($plan);
        $this->_em->flush();
    }

    /**
     * @param User $user
     * @param string $file
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function setAvatar(User $user, string $file)
    {
        $user->setPhoto($file);
        $this->_em->flush();
    }
}